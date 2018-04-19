<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tont extends Model
{
    	 protected $fillable = [
			'nom',
			'descr',
			'mtpart',
			'dtdeb',
			'dtfin',
			'cot_dern',
    ];

	public function groupe()
	{
		// return $this->belongsTo('App\Models\Groupe�);
			return $this->belongsTo(Groupe::class);
	}

	public function tontpers()
 	{
		return $this->hasMany('App\Models\Tontpers');
	}
}
