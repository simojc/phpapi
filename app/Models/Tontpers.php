<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tontpers extends Model
{
		protected $fillable = [
			'position',
			'alias',   	// Pour gérer les cas des personnes qui auront plus d'un nom inscrit	
			'statut',
			'dt_statut',
			'moisgain '
		];
	
		public function tont() 
		{
			// return $this->belongsTo('App\Models\Engmt’); 
			  return $this->belongsTo(Tont::class); 
		};

		public function pers() 
		{
			// return $this->belongsTo('App\Models\Pers’); 
			  return $this->belongsTo(Pers::class); 
		};
}
