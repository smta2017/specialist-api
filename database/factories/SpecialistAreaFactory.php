<?php

namespace Database\Factories;

use App\Models\SpecialistArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialistAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialistArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(1, \config("app.seeder_count")),
        'area_id' => $this->faker->numberBetween(1, \config("app.seeder_count")),
        'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        ];
    }
}
