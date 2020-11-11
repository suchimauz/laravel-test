<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuidoCella\EloquentPopulator\Populator;
use App\Models\Character;
use App\Models\Episode;


class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Populator::setSeeding();
        Character::factory(100)->create();

        $characters = Character::all();

        Episode::all()->each(function ($episode) use ($characters) {
            $episode->characters()->attach(
                $characters->random(rand(5, 15))->pluck('id')->toArray()
            );
        });
    }
}
