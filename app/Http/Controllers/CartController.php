<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function show($id)
    {
        $buyer = User::where('id', $id)->with('userdetail')->first();

        if (!$buyer) {
            return $this->sendResponse('error', 'User Tidak Ada', null, 404);
        }

        $carts = Cart::where('user_id', $id)->with(['product' => function($query) {
            $query->select('id', 'product_name', 'price', 'stock', 'image', 'category_id', 'shop_id');
        }])->get();

        if ($carts->isEmpty()) {
            return $this->sendResponse('error', 'Carts Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', compact('buyer', 'carts'), 200);
    }

    public function store(Request $request, Cart $cart)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|integer',
            'user_id' => 'required|integer',
            'qty' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $cart->product_id = $request->product_id;
        $cart->user_id = $request->user_id;
        $cart->qty = $request->qty;

        try {
            $cart->save();
            
            return $this->sendResponse('success', 'Berhasil Menambahkan ke Keranjang', compact('cart'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Gagal Menambahkan ke Keranjang', $th->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        try {
            $cart->delete();

            return $this->sendResponse('success', 'Produk Dihapus dari Keranjang', null, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Produk Gagal Dihapus dari Keranjang', null, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $cart = Cart::find($id);

        if (!$cart) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        $validator = Validator::make($request->all(), [
            'qty' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $cart->qty = $request->qty;

        try {
            $cart->save();

            return $this->sendResponse('success', 'Berhasil diubah', $cart, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Gagal diubah', null, 404);
        }
    }
}
