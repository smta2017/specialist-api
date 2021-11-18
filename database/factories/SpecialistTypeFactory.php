<?php

namespace Database\Factories;

use App\Models\SpecialistType;
use App\Models\SpecialType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialistTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialistType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::pluck('id')->random(),
        'special_type_id' => SpecialType::pluck('id')->random(),
        'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        ];
    }
}
