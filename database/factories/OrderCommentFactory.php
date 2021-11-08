<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderComment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => Order::pluck('id')->random(),
        'user_id' => User::pluck('id')->random(),
        'body' => $this->faker->text,
        'offer' => $this->faker->numberBetween($min = 1, $max = 300),
        'delivery_date' => $this->faker->date('Y-m-d'),
        'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
        ];
    }
}
