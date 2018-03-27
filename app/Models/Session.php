<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    	 protected $fillable = [
			'name',
			'presenter',
			'duration',
			'level',
			'abstract',     
			];
	
	public voters: string[]

	public function event()
	{
	return $this->belongsTo('App\Models\Event');
	}
}
