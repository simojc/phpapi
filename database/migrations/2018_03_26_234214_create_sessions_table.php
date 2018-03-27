<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');

			$table->string('name');					
			$table->string('presenter');	
			$table->decimal('duration') ;
			$table->string('level');	
			$table->string('abstract');
			$table->integer('session_id');

            $table->timestamps();

			 $table->primary('id');			 
				
			$table->foreign('session_id')
				->references('id')->on('sessions')
				->onDelete('cascade');		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
