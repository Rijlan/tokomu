<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_name', 'description', 'price', 'stock', 'image', 'category_id', 'shop_id'];

    // protected $hidden = ['shop_id', 'category_id'];
    protected $hidden = ['created_at', 'updated_at'];

    public function shop()
    {
        // return $this->belongsTo('App\Shop')->with('owner');
        return $this->belongsTo('App\Shop');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
