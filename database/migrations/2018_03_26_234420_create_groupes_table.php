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

			$table->string('nom')->nullable(false); 									//(exemple Todjom-Qc): string
			$table->string('mtle_reg');   							// (Matricule au r�gistaire des entreprises): string
			$table->string('descr'); 			
			$table->dateTime('dtcre');			
			$table->integer('dureexo');			
			$table->dateTime('dbexo');			
			$table->dateTime('cfinexo');	
			$table->string('contact')->nullable(false);				// (Le r�pondant est une personne du groupe de type membre): Nom & prenom & t�l & couriel du r�pondant
			$table->integer('location_id')->nullable(false); 				  /// Adresse du groupe	  FK vers location
			$table->string('tel')->nullable(false);			
			
			$table->unique('mtle_reg');
			$table->unique('nom');

			//contrainte PK
			//$table->primary('id');

			$table->foreign('location_id')
				->references('id')->on('locations')
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
        Schema::dropIfExists('groupes');
    }
}
