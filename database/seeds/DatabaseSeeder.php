<?php

use Illuminate\Database\Seeder;
use App\Entities\User;
use App\Entities\Sector;

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
        Sector::create([
          'sector_name'      => 'Setor1'

        ]);

        User::create([
          'name'      => 'Admin',
          'phone'     => '987654321',
          'email'     => 'admin',
          'password'  => bcrypt('admin'),
          'sector_id'  => 1,
          'permission'=> 'app.admin'
        ]);



    }
}
