<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horometer extends Model
{
    public function well()
    {
    	return $this->belongsTo(Well::class);
    }
}
