<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'body' => $this->faker->text,
            'user_id' => $this->faker->numberBetween($min = 1, $max = 300),
            'status_id' => 'new',
            "customer_address_id" => $this->faker->numberBetween($min = 1, $max = 300),
            "special_type_id" => $this->faker->numberBetween($min = 1, $max = 300),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')
        ];
    }
}
