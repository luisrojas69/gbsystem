<?php

namespace App;
use App\Specie;
use App\Animal;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
	public function specie()
   {
   	return $this->belongsTo(Specie::class);
   } 

    public function animals(){
    	return $this->hasMany('App\Animal');
    }

    public function getNumAnimalsAttribute(){
    	return count($this->animals);
    }
}
