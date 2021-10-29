<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    public function ministry(){
        return $this->belongsTo('App\Models\Ministry', 'ministry_id');
    }
}
