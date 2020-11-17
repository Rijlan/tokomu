<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function getUserTransactions($id)
    {
        $buyer = User::where('id', $id)->with('userdetail')->first();

        if (!$buyer) {
            return $this->sendResponse('error', 'User Tidak Ada', null, 404);
        }

        $transactions = Transaction::where('user_id', $id)->with('product')->get();

        if ($transactions->isEmpty()) {
            return $this->sendResponse('error', 'Transactions Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', compact('buyer', 'transactions'), 200);
    }

    public function getTransaction($id)
    {
        $transaction = Transaction::where('id', $id)->with('product')->first();

        if (!$transaction) {
            return $this->sendResponse('error', 'Transactions Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', $transaction, 200);
    }

    public function addTransaction(Request $request, Transaction $transaction)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|integer',
            'product_id' => 'required|integer',
            'qty' => 'required|integer|min:0|not_in:0'
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $user = User::find($request->user_id);

        if (!$user) {
            return $this->sendResponse('error', 'Data User Tidak Ada', null, 404);
        }

        $product = Product::find($request->product_id);

        if (!$product) {
            return $this->sendResponse('error', 'Data Produk Tidak Ada', null, 404);
        }
        
        if ($product->stock < $request->qty) {
            return $this->sendResponse('error', 'Stok Tidak Cukup', null, 404);
        } else {
            $product->stock = $product->stock - $request->qty;
            $product->save();
        }

        $shop_id = Product::select('shop_id')->where('id', $request->product_id)->get();

        $shop_id = $shop_id[0]->shop_id;
        
        $transaction->user_id = $request->user_id;
        $transaction->product_id = $request->product_id;
        $transaction->shop_id = $shop_id;
        $transaction->qty = $request->qty;
        $transaction->total = $request->qty * $product->price;
        $transaction->status = 'pending';

        try {
            $transaction->save();
            
            return $this->sendResponse('success', 'Produk Berhasil Dipesan', $transaction, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Produk Gagal Dipesan', $th->getMessage(), 500);
        }

    }

    public function setStatusTransaction(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'in:pending,proccess,done',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return $this->sendResponse('error', 'Data Transaction Tidak Ada', null, 404);
        }

        $transaction->status = $request->status;

        try {
            $transaction->save();
            
            return $this->sendResponse('success', 'Status Berhasil Diupdate', $transaction, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Status Gagal Diupdate', $th->getMessage(), 500);
        }
    }
}
