<?php

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
      DB::table('artists')->truncate();
      $times = ['18:00','18:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30'];
      $faker = Faker\Factory::create('ja_JP');
      foreach (range(0, 9) as $num) {
        DB::table('artists')->insert([
          'event_id' => $num,
          'artist_name' => $faker->text(20),
          'artist_youtube' => $faker->url,
          'artist_tw' => $num . 'twitter',
          'artist_cap' => uniqid() . '.png',
          'artist_time' => $times[$num],
        ]);
      }
    }
}
