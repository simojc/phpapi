<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evnmtdtl extends Model
{
      protected $fillable = [
       'evnmt_id',
       'title',
       'resp',
       'resume',
       'contenu',
       'duree',
       ];

    public voters: string[]

    public function evnmt()
    {
      return $this->belongsTo('App\Models\Evnmt');
    }
}
