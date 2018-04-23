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

          	$table->integer('evnmt_id');
            $table->integer('ordre');
          	$table->string('resp'); 		//Responsable de l''activité
          	$table->string('resume');
            $table->string('title');
          	$table->text('contenu');
          	$table->integer('duree');

          	$table->foreign('evnmt_id')
                ->references('id')->on('evnmt')
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
