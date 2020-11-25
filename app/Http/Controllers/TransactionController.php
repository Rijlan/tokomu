<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Invoice;
use App\Product;
use App\Shop;
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

        $transactions = Transaction::where('user_id', $id)->with(['product' => function($query) {
            $query->select(['id', 'product_name', 'price', 'stock', 'image']);
        }])->get();

        if ($transactions->isEmpty()) {
            return $this->sendResponse('error', 'Transactions Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', compact('buyer', 'transactions'), 200);
    }

    public function getTransaction($id)
    {
        $transaction = Transaction::where('id', $id)->with(['product' => function($query) {
            $query->select(['id', 'product_name', 'price', 'stock', 'image', 'shop_id']);
        }])->first();
        
        if (!$transaction) {
            return $this->sendResponse('error', 'Transactions Tidak Ada', null, 404);
        }

        $shop = Shop::where('id', $transaction->product->shop_id)->with('shopdetail')->first();

        return $this->sendResponse('success', 'Data Berhasil Diambil', compact('transaction', 'shop'), 200);
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
        $transaction->status = 'belum dibayar';

        $cart = Cart::where('user_id', $request->user_id)->where('product_id', $request->product_id)->first();
        if (!$cart) {
            return $this->sendResponse('error', 'Cart Tidak Ada', null, 500);
        }
        $cart->delete();

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
            'status' => 'in:belum dibayar,diproses,dikirim,selesai,dibatalkan',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $transaction = Transaction::find($id);

        if (!$transaction) {
            return $this->sendResponse('error', 'Data Transaction Tidak Ada', null, 404);
        }

        if ($transaction->status == 'dibatalkan') {
            return $this->sendResponse('error', 'Transactions Sudah Dibatalkan', null, 404);
        }

        if ($request->status == 'dibatalkan') {
            $product = Product::find($transaction->product_id);
            $product->stock = $product->stock + $transaction->qty;
            $product->save();
        }

        $transaction->status = $request->status;

        try {
            $transaction->save();
            
            return $this->sendResponse('success', 'Status Berhasil Diupdate', $transaction, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Status Gagal Diupdate', $th->getMessage(), 500);
        }
    }

    public function approveTransaction(Request $request)
    {
        $transaction = Transaction::find($request->transaction_id);

        if (!$transaction) {
            return $this->sendResponse('error', 'Transactions Tidak Ada', null, 404);
        }

        $transaction->status = 'diproses';
        $transaction->save();

        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|unique:invoices',
            'receipt' => 'required|string|unique:invoices',
            'delivery_service' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $invoice = new Invoice;

        $invoice->transaction_id = $request->transaction_id;
        $invoice->receipt = $request->receipt;
        $invoice->delivery_service = $request->delivery_service;

        try {
            $invoice->save();
            
            return $this->sendResponse('success', 'Pembayaran Dikonfirmasi', $invoice, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Pembayaran Gagal Dikonfirmasi', $th->getMessage(), 500);
        }
    }

    public function getTransactionByStatus(Request $request, $shop_id)
    {
        $transactions = Transaction::where('shop_id', $shop_id)->where('status', $request->status)->get();

        if ($transactions->isEmpty()) {
            return $this->sendResponse('error', 'Transactions Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Data Berhasil Diambil', $transactions, 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return $this->sendResponse('error', 'Data Transaction Tidak Ada', null, 404);
        }

        try {
            $transaction->delete();
            
            return $this->sendResponse('success', 'Transaksi Dihapus', null, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Transaksi Gagal Dihapus', $th->getMessage(), 500);
        }
    }
}
