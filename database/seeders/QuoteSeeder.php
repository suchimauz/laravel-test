<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;
use GuidoCella\EloquentPopulator\Populator;
use App\Models\Quote;

use function PHPUnit\Framework\isEmpty;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Populator::setSeeding();
        Quote::factory(500)->create();

        Character::all()->each(function ($character) {
            Quote::whereNull('character_id')
                ->orderByRaw("RAND()")
                ->limit(rand(3, 7))
                ->get()
                ->each(function ($quote) use ($character) {
                    $quote->update(['character_id' => $character->id]);
                });
        });
    }
}
