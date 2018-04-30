<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvnmtdtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evnmtdtls', function (Blueprint $table) {
            $table->increments('id');

          	$table->unsignedInteger('evnmt_id');
          	$table->string('resp'); 		//Responsable de l''activité
          	$table->string('resume');
            $table->string('title');
          	$table->text('contenu');
          	$table->integer('duree');
            $table->integer('ordre');

            	//	$table->primary('id');

          	$table->foreign('evnmt_id')
                ->references('id')->on('evnmts')
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
        Schema::dropIfExists('evnmtdtls');
    }
}
