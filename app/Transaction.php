<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['product_id', 'user_id', 'shop_id', 'qty', 'total', 'status'];

    public function product()
    {
        return $this->belongsTo('App\Product')->with('shop');
    }
}
