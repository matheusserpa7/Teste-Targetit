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
      //  $this->call(UsersTableSeeder::class);
        Sector::create([
          'sector_name'      => 'Admin'

        ]);

        User::create([
          'name'      => 'admin',
          'phone'     => '987654321',
          'email'     => 'Admin',
          'password'  => bcrypt('admin'),
          'sector_id'  => 1
        ]);



    }
}
