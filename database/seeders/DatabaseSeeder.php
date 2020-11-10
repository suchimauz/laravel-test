<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EpisodeSeeder::class);
        $this->call(CharacterSeeder::class);
        $this->call(QuoteSeeder::class);
    }
}
