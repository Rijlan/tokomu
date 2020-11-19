<?php

namespace App\Http\Controllers;

use App\ShopDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopDetailController extends Controller
{
    public function addAccount(Request $request, ShopDetail $shopDetail)
    {
        $validator = Validator::make($request->all(), [
            'shop_id' => 'required|integer',
            'nama_rekening' => 'required|string',
            'no_rekening' => 'required|string',
            'nama_bank' => 'required|string',
            'kode_bank' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $shopDetail->shop_id = $request->shop_id;
        $shopDetail->nama_rekening = $request->nama_rekening;
        $shopDetail->no_rekening = $request->no_rekening;
        $shopDetail->nama_bank = $request->nama_bank;
        $shopDetail->kode_bank = $request->kode_bank;

        try {
            $shopDetail->save();

            return $this->sendResponse('success', 'Detail Toko Berhasil Ditambah', $shopDetail, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Detail Toko Gagal Ditambah', $th->getMessage(), 500);
        }
    }

    public function updateAccount(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_rekening' => 'string',
            'no_rekening' => 'string',
            'nama_bank' => 'string',
            'kode_bank' => 'string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $shopDetail = ShopDetail::where('id', $id)->first();

        if (!$shopDetail) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }
        
        $data = $request->all();

        $result = array_filter($data);

        try {
            $shopDetail->update($result);

            return $this->sendResponse('success', 'Detail Toko Berhasil Diupdate', $shopDetail, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Detail Toko Gagal Diupdate', $th->getMessage(), 500);
        }
    }

    public function getAccount($id)
    {
        $shopDetail = ShopDetail::where('id', $id)->first();

        if (!$shopDetail) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Detail Toko Berhasil Diambil', $shopDetail, 200);
    }

    public function getShopAccount($shop_id)
    {
        $shopDetail = ShopDetail::where('shop_id', $shop_id)->get();

        if ($shopDetail->isEmpty()) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Detail Toko Berhasil Diambil', $shopDetail, 200);
    }

    public function deleteAccount($id)
    {
        $shopDetail = ShopDetail::where('id', $id)->first();

        if (!$shopDetail) {
            return $this->sendResponse('error', 'Data Tidak Ada', null, 404);
        }

        try {
            $shopDetail->delete();

            return $this->sendResponse('success', 'Detail Toko Berhasil Dihapus', null, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Detail Toko Gagal Dihapus', $th->getMessage(), 500);
        }
    }
}
