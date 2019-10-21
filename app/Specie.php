<?php

namespace App;
use App\Breed;
use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    public function breeds(){
    	return $this->hasMany('App\Breed');
    }

    public function getNumBreedsAttribute(){
    	return count($this->breeds);
    }
}
