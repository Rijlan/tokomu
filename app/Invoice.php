<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['transaction_id', 'receipt', 'delivery_service'];

    public function transaction()
    {
        return $this->belongsTo('App\Transaction')->with('buyer', 'product');
    }
}
