<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopDetail extends Model
{
    protected $fillable = ['shop_id', 'nama_rekening', 'no_rekening', 'nama_bank', 'kode_bank'];

    protected $hidden = ['created_at', 'updated_at'];
}
