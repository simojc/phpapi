<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvnmtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evnmts', function (Blueprint $table) {
        $table->increments('id');

  			$table->unsignedInteger('groupe_id');
  			$table->string('nom');
  			$table->dateTime('date');
  			$table->string('hrdeb');
  			$table->string('hrfin');
  			$table->string('statut');
  			$table->string('descr');			// (longue description , famille acueil, tout autres info pertinantes)
  			$table->text('contenu');
  			$table->unsignedInteger('location_id'); 				  /// Adresse du groupe	  FK vers location
  			$table->string('rapport');			//(nom du fichier ....rapport)
  			$table->string('famaccueil')->nullable();	;			//(pers_id)
  			$table->integer('resp1')->nullable();	;		 	//(pers_id)
  			$table->integer('resp2')->nullable();	;			 //(pers_id)
  			$table->boolean('affich');		 	//(affiche cet evnmt dans la page d'acceuile? Oui/Non)

				//Contraintes
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
        Schema::dropIfExists('evnmts');
    }
}
