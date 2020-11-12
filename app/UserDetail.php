<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $fillable = ['user_id', 'phone_number', 'address', 'avatar'];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
