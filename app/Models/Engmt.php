<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engmt extends Model
{
    //
		   protected $fillable = [
			'nom', 'descr', 'periodicite',
			'periode', 'statut', 'mont_unit',
			'totalper','dt_ech'
		];

		public function groupe()
		{
			// return $this->belongsTo('App\Models\Groupee);
			  return $this->belongsTo(Groupe::class);
		}

		public function engmtpers()
 		{
			return $this->hasMany('App\Models\Engmtpers');
		}

}
