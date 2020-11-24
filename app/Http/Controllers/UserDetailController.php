<?php

namespace App\Http\Controllers;

use App\User;
use App\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
            $image = $request->file('avatar');
            $file = base64_encode(file_get_contents($image));

            $client = new \GuzzleHttp\Client();
            $response = $client->request('POST', 'https://freeimage.host/api/1/upload', [
                'form_params' => [
                    'key' => '6d207e02198a847aa98d0a2a901485a5',
                    'action' => 'upload',
                    'source' => $file,
                    'format' => 'json'
                ]
            ]);

            $data = $response->getBody()->getContents();
            $data = json_decode($data);
            $image = $data->image->url;

            $userDetail->avatar = $image;
        }

        try {
            $userDetail->save();

            $user = User::where('id' ,$request->user_id)->with('userdetail')->first();

            return $this->sendResponse('success', 'Detail Berhasil Ditambah', compact('user'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Detail Gagal Ditambah', $th->getMessage(), 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        
        if (!$user) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'email' => 'email|unique:users,email,'.$user->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $data = $request->all();

        $result = array_filter($data);

        try {
            $user->update($result);

            return $this->sendResponse('success', 'Detail Berhasil Diupdate', compact('user'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Detail Gagal Diupdate', null, 500);
        }
    }
}
