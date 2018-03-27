<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTontpersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tontpers', function (Blueprint $table) {
            $table->increments('id');

			$table->integer('tont_id');			
			$table->integer('pers_id');			//  (fk vers table personne; contrainte: la personne doit être de type membre)
			$table->integer('position');			
			$table->string('alias');		// si une pers a plus d''un nom  		
			$table->string('statut');			  //(bouffé / non bouffé)
			$table->string('comment');
			$table->dateTime('dt_statut');	
			
			//Contraintes
			$table->primary('id');

			$table->foreign('tont_id')
				  ->references('id')->on('tonts')
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
        Schema::dropIfExists('tontpers');
    }
}
