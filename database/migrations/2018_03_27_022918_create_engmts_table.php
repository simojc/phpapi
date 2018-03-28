<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEngmtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('engmts', function (Blueprint $table) {
            $table->increments('id');

			$table->integer('groupe_id');			
			$table->string('nom');		 			
			$table->string('descr');			
			$table->string('periodicite');	
			$table->string('periode');	
			$table->string('statut');   ///--- valeurs: En cours, à venir, fermé selon la période
			$table->integer('mont_unit');		
			$table->integer('totalper');   /// solde période
			//contraintes
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
        Schema::dropIfExists('engmts');
    }
}
