<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    protected $fillable = ['transaction_id', 'image'];

    public function transaction()
    {
        return $this->belongsTo('App\Transaction')->with('buyer', 'product');
    }

    // public function transactionWithProductAndBuyer()
    // {
    //     return $this->belongsTo('App\Transaction')->with('buyer', 'product');
    // }
}
