<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    public function varieties()
    {
      return $this->hasMany(Variety::class);
    }
}
