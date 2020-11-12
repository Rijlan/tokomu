aa<?php

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
                    'error' => 'invalid_credentials'
                ], 400);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'could_not_create_token'
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
                return response()->json(['user_not_found'], 404);
            }
        } catch (Tymon\JWTAuth | Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth | Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth | Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
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
}
