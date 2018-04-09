<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pers', function (Blueprint $table) {
            $table->increments('id');

			$table->unsignedInteger('user_id')->nullable(false); 		//  (Une personne est rattace e un utilisateur existant, ce qui fait aussi le lien avec le groupe)
			$table->string('type')->nullable(false);				// (membre,fils/fille du membre, conjoint/conjointe du membre,  cousin/cousine du membre, niece/neuveu du membre, frere / soeur du membre, ami/amie du membre, autre lien du membre)
			$table->string('nom')->nullable(false);
			$table->string('prenom')->nullable(false);
			$table->string('sexe')->nullable(false);
			$table->string('email')->nullable(false);
			$table->string('telcel')->nullable(false);
			$table->string('telres');
			$table->unsignedInteger('location_id'); 				  /// Adresse du groupe	  FK vers location
			$table->string('emploi');
			$table->string('dom_activ')->nullable();	 	//	(domaine d'activite de la personne)
			$table->string('titre_adh')->nullable();	 	// 	(Le titre d'adhesion ou responsabilite au sein du groupe: membre regulier, president, secretaire, commissaire aucompte etc...)

			// contraintes PK et FK
			//$table->primary('id');
			$table->foreign('user_id')
			  ->references('id')->on('users')
			  ->onDelete('cascade');
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
        Schema::dropIfExists('pers');
    }
}
