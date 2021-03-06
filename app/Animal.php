<?php

namespace App;
use App\Weighing;
use App\Breed;
use App\Sanitation;
use App\Paddock;
use App\Rodeo;
use App\Specie;
use App\LotAnimal;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{

	public function breed()
	{
		return $this->belongsTo(Breed::class);
	}

	public function lotAnimal()
	{
		return $this->belongsTo(LotAnimal::class);
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

	public function getNumWeighingsAttribute(){
		return count($this->weighings);
	}


	public function sanitations(){
		return $this->hasMany('App\Sanitation');
	}

	public function scopeRodeo($query, $rodeo)
	{ 
		$query->where('rodeo_id', "%$rodeo%");
	} 

	public function scopeName($query, $name)
	{	
		if(trim($name) != "")
		{
			$query->where('animal_cod', "LIKE", "%$name%")->orWhere('animal_na', "LIKE", "%$name%");
		}
	}

}
