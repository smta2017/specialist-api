<?php

namespace Database\Factories;

use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\SpecialTypes;
use App\Models\User;
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
            'user_id' => User::pluck('id')->random(),
            'order_state_id' => OrderState::pluck('id')->random(),
            "customer_address_id" =>  CustomerAddress::pluck('id')->random() ,
            "special_type_id" => SpecialTypes::pluck('id')->random(),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null) // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')
        ];
    }
}
