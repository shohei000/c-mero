<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //User テーブル全けし
      User::truncate();


      DB::table('users')->insert([
        'name' => "syousinnge@gmail.com",
        'email' => "syousinnge@gmail.com",
        'password' => bcrypt('syousinnge@gmail.com'),
        'role' => 1,
      ]);

      $faker = Faker\Factory::create('ja_JP');
      for($i = 0; $i < 10; $i++) {
        DB::table('users')->insert([
          'name' => $faker->name,
          'email' => $faker->email,
          'password' => bcrypt( $faker->password),
          'role' => 2,
        ]);
      }
    }
}
