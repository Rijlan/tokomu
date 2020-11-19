<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['shop_name', 'description', 'image', 'user_id'];
    
    // protected $hidden = ['user_id'];
    protected $hidden = ['created_at', 'updated_at'];
    
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function products()
    {
        return $this->hasManyThrough('App\Product', 'App\User');
    }

    public function shopdetail()
    {
        return $this->hasMany('App\ShopDetail');
    }
}
