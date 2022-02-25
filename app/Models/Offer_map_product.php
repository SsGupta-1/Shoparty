<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offer_map_product extends Model
{
    use SoftDeletes;
    //protected $softDelete = true;
    protected $fillable = [
        'product_id','offer_id'
    ];

}
