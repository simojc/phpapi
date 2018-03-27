<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pers extends Model
{
    protected $fillable = [
				'type',
				'nom',
				'prenom',
				'sexe',
				'email',
				'telcel',
				'telres',
				'emploi',
				'dom_activ',
				'titre_adh',   
				]
	

		public function engmtpers()
 		{ 
			return $this->hasMany('App\Models\Engmtpers'); 
		}

		public function location()
		{
		return $this->belongsTo('App\Models\Location');
		}

		public function user()
		{
		return $this->belongsTo('App\Models\User');
		}

		public function tontpers()
 		{ 
			return $this->hasMany('App\Models\Tontpers'); 
		}

		public function rpnpers()
 		{ 
			return $this->hasMany('App\Models\Rpnpers'); 
		}

		public function engmtpers()
 		{ 
			return $this->hasMany('App\Models\Engmtpers'); 
		}

}
