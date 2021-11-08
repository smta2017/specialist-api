<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubscriptionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subscription::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::pluck('id')->random(),
        'plan_id' => Plan::pluck('id')->random(),
        'start_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null),
        'end_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null),
        'order_count' => $this->faker->numberBetween($min = 1, $max = 300),
        'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        ];
    }
}
