<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tonts', function (Blueprint $table) {
            $table->increments('id');

			$table->unsignedInteger('groupe_id');
			$table->string('nom');
			$table->string('descr');
			$table->integer('mtpart');
			$table->dateTime('dtdeb');
			$table->dateTime('dtfin');
			$table->string('cot_dern');		  /// Ce champ est encore e analyser

			// Contraintes
			//$table->primary('id');
			$table->foreign('groupe_id')
			  ->references('id')->on('groupes')
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
        Schema::dropIfExists('tonts');
    }
}
