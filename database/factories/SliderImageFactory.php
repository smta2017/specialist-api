<?php

namespace Database\Factories;

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
        'start_date' => $this->faker->word,
        'end_date' => $this->faker->word,
        'is_active' => $this->faker->word,
        'slider_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
