<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Engmtpers extends Model
{
 protected $fillable = [
    'exercice','mont','statut', 'dtchgst','message','dt_ech',
	]

	//Les infos à afficher sont: montant payé, mt restant, statu, un essage
	//
		public function engmt() 
		{
			// return $this->belongsTo('App\Models\Engmt’); 
			  return $this->belongsTo(Engmt::class); 
		};

		public function pers() 
		{
			// return $this->belongsTo('App\Models\Pers’); 
			  return $this->belongsTo(Pers::class); 
		};
}
