<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    	 protected $fillable = [
							'nom',
							'mtle_reg',
							'descr',
							'dtcre',
							'dureexo',
							'dbexo',
							'cfinexo',
							'contact',
							'tel',
					];

		public function evnmts()
 		{
			return $this->hasMany('App\Models\Evnmt');
		}

		public function users()
 		{
			return $this->hasMany('App\Models\User');
		}

		public function tonts()
 		{
			return $this->hasMany('App\Models\Tont');
		}

		public function rpnpers()
 		{
			return $this->hasMany('App\Models\Rpnpers');
		}

		public function engmts()
 		{
			return $this->hasMany('App\Models\Engmt');
		}

		public function location()
		{
			return $this->belongsTo('App\Models\Location');
		}

}
