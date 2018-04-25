<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
      $table->increments('id');
			$table->string('name');
			$table->dateTime('date');
			$table->string('time');
			$table->decimal('price');
			$table->string('imageUrl');
			// $table->unsignedInteger('location_id');
			
			$table->string('address');
			$table->string('city');
			$table->string('country');
		
			$table->string('onlineUrl');
					
			//$table->primary('id');
			// $table->foreign('location_id')
				// ->references('id')->on('locations')
				// ->onDelete('cascade');

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
        Schema::dropIfExists('events');
    }
}
