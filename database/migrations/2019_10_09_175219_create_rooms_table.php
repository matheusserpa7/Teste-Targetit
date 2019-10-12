<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateRoomsTable.
 */
class CreateRoomsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rooms', function(Blueprint $table) {

            $table->increments('id');
						$table->char('room_identification',15);

            $table->timestamps();
						$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
			Schema::table('rooms', function(Blueprint $table) {

			});
		Schema::drop('rooms');
	}
}
