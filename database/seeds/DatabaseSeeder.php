<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        User::create([
          'name'      => 'Admin',
          'phone'     => '987654321',
          'email'     => 'admin',
          'password'  => bcrypt('admin'),
          'setor_id'  => 1,
          'permission'=> 'app.admin'
        ]
        );



    }
}
