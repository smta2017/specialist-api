<?php

namespace Database\Factories;

use App\Models\OrderComment;
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
            'order_id' => $this->faker->randomDigitNotNull,
        'user_id' => $this->faker->randomDigitNotNull,
        'body' => $this->faker->text,
        'offer' => $this->faker->randomDigitNotNull,
        'delivery_date' => $this->faker->date('Y-m-d'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
