<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Episode;
use App\Models\Quote;
use GuidoCella\EloquentPopulator\Populator;
use Illuminate\Database\Seeder;

class BreakingBadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Populator::setSeeding();

        $episodes = Episode::factory(30)->create();
        $characters = Character::factory(100)->create();

        foreach ($episodes as $episode) {
            $episode->characters()->attach(
                $characters->random(rand(5, 15))
            );
        }

        foreach ($characters as $character) {
            $quotes = Quote::factory(rand(3, 7))->create([
                'character_id' => $character->id,
                'episode_id' => NULL,
            ]);

            foreach ($quotes as $quote) {
                $characterEpisode = $character->episodes()->inRandomOrder()->first();

                $quote->update([
                    'episode_id' => isset($characterEpisode) ? $characterEpisode->id : NULL,
                ]);
            }
        }
    }
}
