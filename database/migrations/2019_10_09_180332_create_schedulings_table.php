<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSchedulingsTable.
 */
class CreateSchedulingsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('schedulings', function(Blueprint $table) {
            $table->increments('id');

						$table->integer('user_id')->unsigned();
						$table->integer('room_id')->unsigned();
						$table->DateTime('date');

            $table->timestamps();

						$table->foreign('user_id')->references('id')->on('users');
						$table->foreign('room_id')->references('id')->on('rooms');
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
		Schema::table('schedulings', function(Blueprint $table) {
			$table->dropForeign('schedulings_user_id_foreign');
			$table->dropForeign('schedulings_room_id_foreign');
		});
		Schema::drop('schedulings');
	}
}
