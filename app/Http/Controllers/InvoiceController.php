<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        $validator = Validator::make($request->all(), [
            'receipt' => 'string',
            'delivery_service' => 'string',
        ]);

        if ($validator->fails()) {
            return response($validator->errors());
        }

        $data = $request->all();

        $result = array_filter($data);

        try {
            $invoice->update($result);
            
            return $this->sendResponse('success', 'Resi Berhasil Diupdate', compact('invoice'), 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Resi Gagal Diupdate', $th->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        $invoice = Invoice::find($id);

        try {
            $invoice->delete();
            
            return $this->sendResponse('success', 'Resi Berhasil Dihapus', null, 200);
        } catch (\Throwable $th) {
            return $this->sendResponse('error', 'Resi Gagal Dihapus', $th->getMessage(), 500);
        }
    }

    public function getInvoice($id)
    {
        $payment = Invoice::where('id', $id)->with('transaction')->get();

        if ($payment->isEmpty()) {
            return $this->sendResponse('error', 'Resi Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Resi Berhasil Diambil', compact('payment'), 200);
    }

    public function getTransactionInvoice($transaction_id)
    {
        $payment = Invoice::where('transaction_id', $transaction_id)->with('transaction')->get();

        if ($payment->isEmpty()) {
            return $this->sendResponse('error', 'Resi Tidak Ada', null, 404);
        }

        return $this->sendResponse('success', 'Resi Berhasil Diambil', compact('payment'), 200);
    }
}
