<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOrderList extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_list' ,
        'user_id' ,
        'product_id' ,
        'qty' ,
        'total' ,
        'order_code' ,
        'status'
    ];
}
