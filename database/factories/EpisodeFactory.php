<?php

namespace Database\Factories;

use App\Models\Episode;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuidoCella\EloquentPopulator\Populator;

class EpisodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Episode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        return array_merge(Populator::guessFormatters($this->model), [
            'title' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
        ]);
    }
}
