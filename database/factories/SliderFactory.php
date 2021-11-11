<?php

namespace Database\Factories;

use App\Models\Slider;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Slider::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'slider_type' => $this->faker->randomElement(['banner', 'slider']),
            'slides_per_page' => $this->faker->randomDigitNotNull,
            'auto_play' => $this->faker->randomDigitNotNull,
            'slider_width' => $this->faker->word,
            'slider_height' => $this->faker->word,
            'is_active' => $this->faker->randomElement(['0', '1']),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')
        ];
    }
}
