<?php

namespace App\Http\Controllers;

use App\Shop;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function getShops()
    {
        $shops = Shop::all();

        if ($shops->isEmpty()) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', $shops, 200);
    }

    public function getShop($id)
    {
        $shop = Shop::find($id);

        if (!$shop) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', $shop, 200);
    }

    public function setShop(Request $request, Shop $shop)
    {
        if (!User::find($request->user_id)) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'shop_name' => 'required|string',
            'description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        if (!Shop::where('user_id', $request->user_id)->count() < 1) {
            $shop = Shop::where('user_id', $request->user_id)->first();
        }

        $shop->shop_name = $request->shop_name;
        $shop->description = $request->description;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $image = time() . $file->getClientOriginalName();

            $file->move(public_path('uploads/products'), $image);

            $shop->image = $image;
        }
        $shop->user_id = $request->user_id;

        try {
            $shop->save();

            $shop = Shop::where('user_id', $request->user_id)->with('owner')->first();
            return $this->sendResponse('success', 'Toko Berhasil Ditambah', compact('shop'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Toko Gagal Ditambah', $th->getMessage(), 500);
        }
    }
}
