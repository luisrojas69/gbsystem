<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
   public function sector()
   {
   	return $this->belongsTo(Sector::class);
   } 

    /*
    * Get Records of Planks
    */
    public function planks()
    {
      return $this->hasMany(Plank::class);
    }

    public function getNumPlanksAttribute(){
      return count($this->planks);
    } 
}

