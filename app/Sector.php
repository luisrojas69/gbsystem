<?php

namespace App;
use App\Lot;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{	
	protected $fillable = [
        'sector_co', 'sector_de',
    ];

    public function lots(){
    	return $this->hasMany('App\Lot');
    }

    public function getNumLotsAttribute(){
    	return count($this->lots);
    }

    public function scopeName($query, $name)
    {	
    	if(trim($name) != "")
    	{
    	$query->where('sector_de', "LIKE", "%$name%");
    	}
    }	
}

