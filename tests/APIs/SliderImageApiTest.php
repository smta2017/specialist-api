<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SliderImage;

class SliderImageApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_slider_image()
    {
        $sliderImage = SliderImage::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/slider_images', $sliderImage
        );

        $this->assertApiResponse($sliderImage);
    }

    /**
     * @test
     */
    public function test_read_slider_image()
    {
        $sliderImage = SliderImage::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/slider_images/'.$sliderImage->id
        );

        $this->assertApiResponse($sliderImage->toArray());
    }

    /**
     * @test
     */
    public function test_update_slider_image()
    {
        $sliderImage = SliderImage::factory()->create();
        $editedSliderImage = SliderImage::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/slider_images/'.$sliderImage->id,
            $editedSliderImage
        );

        $this->assertApiResponse($editedSliderImage);
    }

    /**
     * @test
     */
    public function test_delete_slider_image()
    {
        $sliderImage = SliderImage::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/slider_images/'.$sliderImage->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/slider_images/'.$sliderImage->id
        );

        $this->response->assertStatus(404);
    }
}
