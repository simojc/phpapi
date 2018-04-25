<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRpnpersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('rpnpers', function (Blueprint $table) {
      $table->increments('id');

      $table->unsignedInteger('groupe_id');
      $table->unsignedInteger('pers_id');		  //(fk vers table personne, la personne inscrite)
      $table->unsignedInteger('repdt1_id');		// (fk vers table personne, le repondant doit etre une personne de type membre)
	  $table->unsignedInteger('repdt2_id');		// (fk vers table personne, le repondant doit etre une personne de type membre)
      $table->dateTime('dtadh');		//   (date d'adhesion)
      $table->string('mtrle');		//  (matricule rpn)
      $table->integer('depot');
      $table->dateTime('dtmajdpt');

      //Contraintes
      //$table->primary('id');
      $table->foreign('groupe_id')
      ->references('id')->on('groupes')
      ->onDelete('cascade');
      $table->foreign('pers_id')
      ->references('id')->on('pers')
      ->onDelete('cascade');
	     $table->foreign('repdt1_id')
      ->references('id')->on('pers')
      ->onDelete('cascade');
	     $table->foreign('repdt2_id')
      ->references('id')->on('pers')
      ->onDelete('cascade');

      $table->timestamps();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('rpnpers');
  }
}
