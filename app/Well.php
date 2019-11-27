<?php

namespace App;
use App\Horometer;

use Illuminate\Database\Eloquent\Model;

class Well extends Model
{

	public function horometers(){
		return $this->hasMany('App\Horometer');
	}


	public function getNumHorometersAttribute(){
		return count($this->horometers);
	}


	public function scopeName($query, $name)
	{	
		if(trim($name) != "")
		{
			$query->where('well_na', "LIKE", "%$name%");
		}
	}	   
}
