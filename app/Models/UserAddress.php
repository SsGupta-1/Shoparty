<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $fillable=['user_id','first_name','last_name','city','country_id','street_no','building_no','mobile'];
    protected $dates = ['deleted_at'];



}
