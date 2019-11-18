<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plank extends Model
{
    public function lot()
    {
    	return $this->belongsTo(Lot::class);
    }

    public function scopeName($query, $name)
    {
    	if(trim($name) != "")
    	{
    	$query->where('plank_de', "LIKE", "%$name%");
    	}
    }	
}
