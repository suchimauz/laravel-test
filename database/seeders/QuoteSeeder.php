<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $episode_character = [];

        $quotes = [];
        $quotes_count = 500;

        $quotes_for_one_episode = 17;
        $quotes_for_one_character = 5;

        while($quotes_count > 0) {
            $episode_id = ceil($quotes_count / $quotes_for_one_episode);
            $character_id = ceil($quotes_count / $quotes_for_one_character);

            $quotes[] = [
                'quote' => Str::random(50),
                'episode_id' => $episode_id,
                'character_id' => $character_id,
            ];

            $episode_character[] = [
                'episode_id' => $episode_id,
                'character_id' => $character_id
            ];

            $quotes_count--;
        }

        DB::table('quotes')->insert($quotes);
        DB::table('episode_character')->insert($episode_character);
    }
}
