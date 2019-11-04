<?php

namespace App;
use App\Weighing;
use App\Breed;
use App\Sanitation;
use App\Paddock;
use App\Rodeo;
use App\Specie;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{

   public function breed()
   {
   	return $this->belongsTo(Breed::class);
   }

   public function paddock()
   {
   	return $this->belongsTo(Paddock::class);
   }

   public function rodeo()
   {
    return $this->belongsTo(Rodeo::class);
   }

   public function weighings()
   {
   	return $this->hasMany('App\Weighing');
   }

    public function sanitations(){
    	return $this->hasMany('App\Sanitation');
    }

}
