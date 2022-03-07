<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipIndividual extends Model
{
    use HasFactory;

    public function country(){
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function state(){
        return $this->belongsTo('App\Models\State', 'state_id');
    }

    public function city(){
        return $this->belongsTo('App\Models\City', 'city_id');
    }
}
