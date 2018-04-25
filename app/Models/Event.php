<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

	 protected $fillable = [
			'name',
			'date',
			'time',
			'price',
			'address',
    			'city',
    			'country',
			'imageUrl',
			'onlineUrl',
	];

	public function sessions()
 	{
		return $this->hasMany('App\Models\Session');
	}

	// public function location()
	// {
	// return $this->belongsTo('App\Models\Location');
	// }


}
