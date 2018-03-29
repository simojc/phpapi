<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngmtpersTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('engmtpers', function (Blueprint $table) {
      $table->increments('id');

      $table->unsignedInteger('engmt_id');
      $table->unsignedInteger('pers_id');		  // (fk vers table personne; contrainte: la personne doit �tre de type membre)
      $table->integer('exercice');
      $table->integer('mont');
      $table->string('statut');
      $table->string('dtchgst');
      $table->string('message');
      $table->dateTime('dt_ech');
      //$table->primary('id');
      $table->foreign('engmt_id')
      ->references('id')->on('engmts')
      ->onDelete('cascade');
      $table->foreign('pers_id')
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
    Schema::dropIfExists('engmtpers');
  }
}
