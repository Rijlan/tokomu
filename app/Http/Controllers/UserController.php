<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'error' => 'Email atau Password salah'
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Tidak bisa membuat Token'
            ], 500);
        }

        return response()->json(compact('token'));
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'role' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'role' => $request->get('role'),
            'password' => Hash::make($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }

    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['User Tidak Ditemukan'], 404);
            }
        } catch (Tymon\JWTAuth | Exceptions\TokenExpiredException $e) {
            return response()->json(['Token Kadaluarsa'], $e->getStatusCode());
        } catch (Tymon\JWTAuth | Exceptions\TokenInvalidException $e) {
            return response()->json(['Token Tidak Valid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth | Exceptions\JWTException $e) {
            return response()->json(['Token Tidak ada'], $e->getStatusCode());
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', compact('user'), 200);
    }

    public function destroy(Request $request)
    {
        $password = $request->password;

        $user = User::find($request->user_id);

        if (!$user) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        if (Hash::check($password, $user->password)) {
            try {
                $user->delete();

                return $this->sendResponse('success', 'Akun Dihapus', null, 200);
            } catch (\Throwable $th) {
                return $this->sendResponse('error', 'Akun Gagal Dihapus', null, 404);
            }
        } else {
            return $this->sendResponse('error', 'Password Salah', null, 404);
        }
    }

    public function changePassword(Request $request,$id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if (Hash::check($request->old_password, $user->password)) {

            $user->password = Hash::make($request->password);

            try {
                $user->save();

                return $this->sendResponse('success', 'Password Diperbarui', null, 200);
            } catch (\Throwable $th) {
                return $this->sendResponse('error', 'Password Gagal Diperbarui', null, 404);
            }
        } else {
            return $this->sendResponse('error', 'Password Salah', null, 404);
        }
    }

    public function logout() 
    {
        if (JWTAuth::invalidate(JWTAuth::getToken())) {
            return $this->sendResponse('success', 'Behasil Logout', null, 200);
        }
        return $this->sendResponse('error', 'Gagal Logout', null, 400);
    }
}
