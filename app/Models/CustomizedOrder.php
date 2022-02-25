<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomizedOrder extends Model
{
    protected $fillable=['name','user_id','product_id','product_detail_id','add_image','background_image','font_name_id','font_color_id','font_size_id']
}
