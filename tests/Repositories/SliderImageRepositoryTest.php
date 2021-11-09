<?php namespace Tests\Repositories;

use App\Models\SliderImage;
use App\Repositories\SliderImageRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SliderImageRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SliderImageRepository
     */
    protected $sliderImageRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->sliderImageRepo = \App::make(SliderImageRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_slider_image()
    {
        $sliderImage = SliderImage::factory()->make()->toArray();

        $createdSliderImage = $this->sliderImageRepo->create($sliderImage);

        $createdSliderImage = $createdSliderImage->toArray();
        $this->assertArrayHasKey('id', $createdSliderImage);
        $this->assertNotNull($createdSliderImage['id'], 'Created SliderImage must have id specified');
        $this->assertNotNull(SliderImage::find($createdSliderImage['id']), 'SliderImage with given id must be in DB');
        $this->assertModelData($sliderImage, $createdSliderImage);
    }

    /**
     * @test read
     */
    public function test_read_slider_image()
    {
        $sliderImage = SliderImage::factory()->create();

        $dbSliderImage = $this->sliderImageRepo->find($sliderImage->id);

        $dbSliderImage = $dbSliderImage->toArray();
        $this->assertModelData($sliderImage->toArray(), $dbSliderImage);
    }

    /**
     * @test update
     */
    public function test_update_slider_image()
    {
        $sliderImage = SliderImage::factory()->create();
        $fakeSliderImage = SliderImage::factory()->make()->toArray();

        $updatedSliderImage = $this->sliderImageRepo->update($fakeSliderImage, $sliderImage->id);

        $this->assertModelData($fakeSliderImage, $updatedSliderImage->toArray());
        $dbSliderImage = $this->sliderImageRepo->find($sliderImage->id);
        $this->assertModelData($fakeSliderImage, $dbSliderImage->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_slider_image()
    {
        $sliderImage = SliderImage::factory()->create();

        $resp = $this->sliderImageRepo->delete($sliderImage->id);

        $this->assertTrue($resp);
        $this->assertNull(SliderImage::find($sliderImage->id), 'SliderImage should not exist in DB');
    }
}
