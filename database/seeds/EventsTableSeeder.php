<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $location_name_list = [
        '恵比寿The Garden Hall',
        '赤坂BLITZ',
        '恵比寿LIQUIDROOM',
        '代官山UNIT',
        '新宿LOFT',
        '新大久保聖地',
        '代官山LOOP',
        '半蔵門WinPa',
        '新代田FEVER',
        '三軒茶屋HEAVEN’S DOOR'
      ];
      DB::table('events')->truncate();
      $faker = Faker\Factory::create('ja_JP');
      $dt = Carbon::now();
      foreach (range(0, 9) as $num) {
        DB::table('events')->insert([
          'user_id' => $num,
          'event_name' => $faker->realText(25),
          'location_name' => $location_name_list[$num],
          'location_url' => $faker->url,
          'open_date' => $dt->format('Y/m/d'),
          'event_open' => '18:30',
          'event_start' => '19:00',
          'ticket_price' => $num . '000円',
          'event_day' => $num,
          'cap_none_num' => rand(1,5),
        ]);
      }
    }
}
