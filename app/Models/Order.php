<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function listOrderDetails()
    {
        return $this->hasMany(OrderDetail::class,'order_id');
    }


}
