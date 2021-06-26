<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->insert([
            'user_id' => 1,
            'images' => ['image.png'],
            'name' => "Tournament Mobile Legends Season 17" ,
            'description' => "tournament ini diselenggarakan untuk memperingati season 17",
            'category' => "game",
            'location' => "china",
            'time' => "12:00",
            'date' => "2021-06-01",
        ]);
    }
}
