<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evnmt extends Model
{
    	 protected $fillable = [
	'nom',
    'date',
    'hrdeb',
    'hrfin',
    'status',    
    'descr',  
	'rapport',
	'resp1',
	'resp2',
	'resp3',
	'affich',
	]
	
		public function groupe() 
		{
			// return $this->belongsTo('App\Models\Groupe�); 
			  return $this->belongsTo(Groupe::class); 
		};

		public function location()
		{
		return $this->belongsTo('App\Models\Location');
		}

		/*
		public function evnmtdtl()
 		{ 
			return $this->hasMany('App\Models\Evnmtdtl'); 
		}
		*/

		
}
