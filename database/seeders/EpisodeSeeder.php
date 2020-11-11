<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuidoCella\EloquentPopulator\Populator;
use \App\Models\Episode;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Populator::setSeeding();
        Episode::factory(30)->create();
    }
}
