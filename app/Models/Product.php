<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $dates = ['deleted_at'];
    public function productImages()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }
    /***************product details********/
    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class,'product_id');
    }
}
