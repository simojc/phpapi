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

			$table->string('type')->nullable(false);				// (membre,fils/fille du membre, conjoint/conjointe du membre,  cousin/cousine du membre, niece/neuveu du membre, frere / soeur du membre, ami/amie du membre, autre lien du membre)
			$table->string('nom')->nullable(false);
			$table->string('prenom')->nullable(false);
			$table->string('sexe')->nullable(false);
			$table->string('email')->nullable(false)->unique();
			$table->string('telcel')->nullable(false);
			$table->string('telres');
			// $table->unsignedInteger('location_id'); 				  /// Adresse du groupe	  FK vers location

			$table->string('address');
			$table->string('city');
			$table->string('country');

			$table->string('emploi');
			$table->string('dom_activ')->nullable();	 	//	(domaine d'activite de la personne)
			$table->string('titre_adh')->nullable();	 	// 	(Le titre d'adhesion ou responsabilite au sein du groupe: membre regulier, president, secretaire, commissaire aucompte etc...)

			$table->unsignedInteger('groupe_id')->nullable(false);
			  // definition des contraintes
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
        Schema::dropIfExists('pers');
    }
}
