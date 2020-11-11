<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
