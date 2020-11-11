<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;
use GuidoCella\EloquentPopulator\Populator;
use \Faker\Provider\Base;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected static $occupations = [
        'Policeman', 'Webmaster', 'Public Relations Manager',
        'Secretary', 'Athlete', 'Receptionist', 'Filmmaker',
        'Dietician', 'Engineer', 'Teaching', 'Bouncer', 'Editor',
        'Waiter', 'Actor', 'News announcer', 'Graphic designer',
        'Carpenter', 'Business analyst', 'Lab assistant', 'Sales Assistant',
        'Physicist', 'Newspaper reporter', 'Computer programmer',
        'Judge', 'Optician', 'Correctional officer', 'Adult Education Teacher',
        'Accountant', 'Attorney', 'Statistician'
    ];

    public function definition() {
        return array_merge(Populator::guessFormatters($this->model), [
            'name' => $this->faker->name,
            'portrayed' => $this->faker->name,
            'nickname' => $this->faker->userName,
            'img' => $this->faker->imageUrl,
            'occupations' => json_encode(Base::randomElements(static::$occupations, $count = Base::randomDigitNotNull()))
        ]);
    }
}
