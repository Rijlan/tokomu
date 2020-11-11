<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserDetailController extends Controller
{
    public function getUserDetails($id)
    {
        $user = User::find($id);

        if (!$user) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $user = User::where('id', $id)->with('userdetail')->first();

        return $this->sendResponse('success', 'Data Berhasil Diambil', compact('user'), 200);
    }

    public function setUserDetails(Request $request, UserDetail $userDetail)
    {
        if (!User::find($request->user_id)) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'phone_number' => 'required|string',
            'address' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        if (!UserDetail::where('user_id', $request->user_id)->count() < 1) {
            $userDetail = UserDetail::where('user_id', $request->user_id)->first();
        }
        
        $userDetail->user_id = $request->user_id;
        $userDetail->phone_number = $request->phone_number;
        $userDetail->address = $request->address;
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $avatar = time() . $file->getClientOriginalName();

            // storage heroku error
            // $file->storeAs('public/products', $avatar);

            // public
            $file->move(public_path('avatars'), $avatar);

            $userDetail->avatar = $avatar;
        }

        try {
            $userDetail->save();

            $user = User::where('id' ,$request->user_id)->with('userdetail')->first();

            return $this->sendResponse('success', 'Detail Berhasil Ditambah', compact('user'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Detail Gagal Ditambah', null, 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if (!$user) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        try {
            $user->save();

            return $this->sendResponse('success', 'Detail Berhasil Diupdate', compact('user'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Detail Gagal Diupdate', null, 500);
        }
    }
}
