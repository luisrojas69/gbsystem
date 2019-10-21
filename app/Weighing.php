<?php

namespace App;
use App\Animal;

use Illuminate\Database\Eloquent\Model;

class Weighing extends Model
{
    public function animal()
   {
   	return $this->belongsTo(Animal::class);
   } 

}
