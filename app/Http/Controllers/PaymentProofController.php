<?php

namespace App\Http\Controllers;

use App\PaymentProof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentProofController extends Controller
{
    public function getPaymentProof($id)
    {
        $payment = PaymentProof::where('id', $id)->with('transaction')->get();

        if ($payment->isEmpty()) {
            return $this->sendResponse('error', 'Bukti Pembayaran Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Bukti Pembayaran Berhasil Diambil', compact('payment'), 200);
    }

    public function getPaymentProofTransaction($transaction_id)
    {
        $payment = PaymentProof::where('transaction_id', $transaction_id)->with('transaction')->get();

        if ($payment->isEmpty()) {
            return $this->sendResponse('error', 'Bukti Pembayaran Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Bukti Pembayaran Berhasil Diambil', compact('payment'), 200);
    }

    public function getPaymentProofShop($shop_id)
    {
        $payments = PaymentProof::whereHas('transaction', function($query) use ($shop_id) {
            $query->where('shop_id', $shop_id);
        })->with('transaction')->get();

        if ($payments->isEmpty()) {
            return $this->sendResponse('error', 'Bukti Pembayaran Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Bukti Pembayaran Berhasil Diambil', compact('payments'), 200);
    }

    public function addPaymentProof(Request $request, PaymentProof $payment)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|unique:payment_proofs',
            'image' => 'required|mimes:jpeg,jpg,png,gif'
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $file = base64_encode(file_get_contents($request->image));

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

        $payment->image = $image;
        $payment->transaction_id = $request->transaction_id;

        try {
            $payment->save();

            return $this->sendResponse('success', 'Bukti Pembayaran Ditambah', $payment, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Bukti Pembayaran Ditambah', $th->getMessage(), 500);
        }
    }
}
