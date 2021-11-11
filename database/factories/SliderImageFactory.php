<?php

namespace Database\Factories;

use App\Models\Slider;
use App\Models\SliderImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class SliderImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SliderImage::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text,
            'description' => $this->faker->text,
            'caption' => $this->faker->text,
            'url' => $this->faker->text,
            'image_name' => $this->faker->text,
            'start_date' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
            'end_date' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
            'is_active' => $this->faker->randomElement(['0', '1']),
            'slider_id' => Slider::pluck('id')->random(),
            'created_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos'),
            'updated_at' => $this->faker->dateTimeBetween($startDate = '-2 years', $endDate = '2years', $timezone = null), // DateTime('2003-03-15 02:00:49', 'Africa/Lagos')
        ];
    }
}
