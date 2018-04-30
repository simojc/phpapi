<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pers extends Model
{
    protected $fillable = [
      	'groupe_id',
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
				'address',
    			'city',
    			'country',
      ];


		public function engmtpers()
 		{
			return $this->hasMany('App\Models\Engmtpers');
		}

		// public function location()
		// {
		// return $this->belongsTo('App\Models\Location');
		// }

		public function tontpers()
 		{
			return $this->hasMany('App\Models\Tontpers');
		}

		public function rpnpers()
 		{
			return $this->hasMany('App\Models\Rpnpers');
		}

		public function groupe()
		{
			// return $this->belongsTo('App\Models\Groupe');
			  return $this->belongsTo(Groupe::class);
		}

}
