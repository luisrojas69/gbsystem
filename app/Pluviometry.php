<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime; 

class Pluviometry extends Model
{
    public function Sector ()
    {
    	return $this->belongsTo(Sector::class);
    }

    
    public function getDateRead()
   {
   	$date = new DateTime($this->attributes['date_read']);
   	return $date->format('Y-m-d');
   }

}


