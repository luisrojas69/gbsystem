<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{

  protected $fillable = [
        'lot_co', 'lot_de', 'sector_id',
  ];

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


   public function scopeName($query, $name)
    { 
      if(trim($name) != "")
      {
      $query->where('lot_de', "LIKE", "%$name%");
      }
    }   
}

