<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupesTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('groupes', function (Blueprint $table) {
      $table->increments('id');
      $table->string('nom')->nullable(false); 		//(exemple Todjom-Qc): string
      $table->string('mtle_reg');   							// (Matricule au registaire des entreprises): string
      $table->string('descr');
      $table->dateTime('dtcre');
      $table->integer('dureexo');
      $table->dateTime('dbexo');
      $table->dateTime('cfinexo');
      $table->string('contact')->nullable(false);				         // (Le repondant est une personne du groupe de type membre): Nom & prenom & tel & couriel du repondant
      $table->unsignedInteger('location_id')->nullable(false); 				  /// Adresse du groupe	  FK vers location
      $table->string('tel')->nullable(false);

      $table->timestamps();

      $table->unique('mtle_reg');
      $table->unique('nom');
      $table->foreign('location_id')
      ->references('id')->on('locations')
      ->onDelete('cascade');

    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('groupes');
  }
}
