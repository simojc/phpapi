<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    	 protected $fillable = [
			'address',
			'city',
			'country',		 
			]	

		public function event()
		{
			return $this->hasOne('App\Models\Event');
		}

		public function evmnt()
		{
			return $this->hasOne('App\Models\Evmnt');
		}

		public function groupe()
		{
			return $this->hasOne('App\Models\Groupe');
		}

		public function pers()
		{
			return $this->hasOne('App\Models\Pers');
		}
}
