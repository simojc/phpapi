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

			$table->integer('groupe_id');		
			$table->integer('pers_id');		  //(fk vers table personne, la personne inscrite)
			$table->integer('repdt_id');		// (fk vers table personne, le répondant doit être une personne de type membre)
			$table->dateTime('dtadh');		//   (date d'adhésion)
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
