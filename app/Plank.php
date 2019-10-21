<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plank extends Model
{
    public function lot()
    {
    	return $this->belongsTo(Lot::class);
    }
}
