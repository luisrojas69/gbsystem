<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variety extends Model
{
    public function crop()
    {
    	return $this->belongsTo(Crop::class);
    }
}
