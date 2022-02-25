<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'en_store_name', 'ar_store_name', 'en_store_address', 'ar_store_address', 'status'
    ];
}
