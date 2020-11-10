<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for($i = 1; $i <= 30; $i++) {
            $data[] = [
                'title' => Str::random(15),
                'air_date' => '1998-11-13'
            ];
        }

        DB::table('episodes')->insert($data);
    }
}
