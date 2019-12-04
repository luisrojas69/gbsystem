<?php

namespace App;
use App\Animal;

use Illuminate\Database\Eloquent\Model;

class LotAnimal extends Model
{
    
    public function animals(){
    	return $this->hasMany('App\Animal');
    }


	public function getNumAnimalsAttribute(){
    	return count($this->animals);
    }

    

    public function scopeName($query, $name)
    {	
    	if(trim($name) != "")
    	{
    	$query->where('lot_de', "LIKE", "%$name%")->orWhere('lot_co', "LIKE", "%$name%");
    	}
    }
}
