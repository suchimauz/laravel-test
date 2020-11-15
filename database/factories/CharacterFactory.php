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

    private static $occupations = [
        'Policeman', 'Webmaster', 'Public Relations Manager',
        'Secretary', 'Athlete', 'Receptionist', 'Filmmaker',
        'Dietician', 'Engineer', 'Teaching', 'Bouncer', 'Editor',
        'Waiter', 'Actor', 'News announcer', 'Graphic designer',
        'Carpenter', 'Business analyst', 'Lab assistant', 'Sales Assistant',
        'Physicist', 'Newspaper reporter', 'Computer programmer',
        'Judge', 'Optician', 'Correctional officer', 'Adult Education Teacher',
        'Accountant', 'Attorney', 'Statistician',
    ];

    private function getRandomOccupations() {
        return Base::randomElements(static::$occupations, $count = rand(1,4));
    }

    public function definition()
    {
        return array_merge(Populator::guessFormatters($this->model), [
            'name' => $this->faker->name,
            'portrayed' => $this->faker->name,
            'nickname' => $this->faker->userName,
            'birthday' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
            'img' => $this->faker->imageUrl(250,250,'people'),
            'occupations' => $this->getRandomOccupations(),
        ]);
    }
}
