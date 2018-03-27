<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
	 protected $fillable = [
			'name',
			'date',
			'time',
			'price',
			'imageUrl',    
			'onlineUrl',   
	]
	

	public function session()
 	{ 
		return $this->hasMany('App\Models\Session'); 
	}

	public function location()
	{
	return $this->belongsTo('App\Models\Location');
	}


}
