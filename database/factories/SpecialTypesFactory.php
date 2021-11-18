<?php

namespace Database\Factories;

use App\Models\SpecialType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
        'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        ];
    }
}
