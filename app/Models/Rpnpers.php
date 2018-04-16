<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpnpers extends Model
{
    	 protected $fillable = [
			'dtadh',
			'mtrle',
			'depot',
			'dtmajdpt',
    ];


		public function groupe()
		{
			// return $this->belongsTo('App\Models\Groupe�);
			  return $this->belongsTo(Groupe::class);
		}

		public function pers()
		{
			// return $this->belongsTo('App\Models\Pers�);
			  return $this->belongsTo(Pers::class);
		}

		public function repdnt()
		{
		// return $this->belongsTo('App\User', 'foreign_key');
			return $this->belongsTo('App\Models\Pers', 'repdt_id');
			  //return $this->belongsTo(Pers::class, 'repdt_id');
		}

}
