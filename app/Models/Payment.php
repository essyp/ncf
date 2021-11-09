<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function order(){
        return $this->belongsTo('App\Order', 'order_id');
    }

    public function donation(){
        return $this->belongsTo('App\Models\Donation', 'donation_id');
    }

    public function gateway(){
        return $this->belongsTo('App\Models\PaymentGateway', 'payment_gateway_id');
    }

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
