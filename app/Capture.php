<?php

namespace App;
use App\Plank;

use Illuminate\Database\Eloquent\Model;

class Capture extends Model
{
    public function plank()
	{
		return $this->belongsTo(Plank::class);
	}
}
