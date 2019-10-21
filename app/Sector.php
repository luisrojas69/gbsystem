<?php

namespace App;
use App\Lot;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function lots(){
    	return $this->hasMany('App\Lot');
    }
}
