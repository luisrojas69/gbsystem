<?php

namespace App;
use App\Animal;
use Illuminate\Database\Eloquent\Model;

class Paddock extends Model
{
	public function animals(){
		return $this->hasMany('App\Animal');
	}

	public function getNumAnimalsAttribute(){
		return count($this->animals);
	}
}
