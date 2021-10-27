<?php

namespace Database\Factories;

use App\Models\CustomerAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerAddress::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'area_id' => $this->faker->randomDigitNotNull,
        'street' => $this->faker->word,
        'is_default' => $this->faker->boolean(),
        'floor_no' => $this->faker->word,
        'build_no' => $this->faker->word,
        'notes' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
