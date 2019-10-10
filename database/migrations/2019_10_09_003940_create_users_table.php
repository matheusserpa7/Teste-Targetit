<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateUsersTable.
 */
class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');

						//dados usuario
						$table->string('name',30);
						$table->char('phone',20);
						$table->char('email',45);
						$table->string('password');
						$table->integer('sector_id')->unsigned();

						//permissão
						$table -> string('permission') ->default('app.user');

            $table->timestamps();
						$table->softDeletes();

						$table->foreign('sector_id')->references('id')->on('sectors');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function(Blueprint $table) {
			$table->dropForeign('users_sector_id_foreign');
		});
		Schema::drop('users');
	}
}
