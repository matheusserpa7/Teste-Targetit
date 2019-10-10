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
						$table->integer('setor_id');

						//permissão
						$table -> string('permission') ->default('app.user');


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
		Schema::table('users', function(Blueprint $table) {

		});
		Schema::drop('users');
	}
}
