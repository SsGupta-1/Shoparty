<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class UserWishlist extends Model
{
    use SoftDeletes;
    protected $fillable=['user_id','product_id','product_detail_id','status'];
    protected $dates = ['deleted_at'];
}
