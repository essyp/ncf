<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany('App\Models\OrderedProduct', 'order_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function gateway(){
        return $this->belongsTo('App\Models\PaymentGateway', 'payment_method');
    }
}
