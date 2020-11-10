<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        for($i = 1; $i <= 100; $i++) {
            $data[] = [
                'name' => Str::random(10),
                'birthday' => '1998-11-13',
                'img' => 'image.jpeg',
                'nickname' => Str::random(7),
                'portrayed' => Str::random(15)
            ];
        }

        DB::table('characters')->insert($data);
    }
}
