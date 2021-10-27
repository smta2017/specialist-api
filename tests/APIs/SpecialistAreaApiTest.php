<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SpecialistArea;

class SpecialistAreaApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/specialist_areas', $specialistArea
        );

        $this->assertApiResponse($specialistArea);
    }

    /**
     * @test
     */
    public function test_read_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/specialist_areas/'.$specialistArea->id
        );

        $this->assertApiResponse($specialistArea->toArray());
    }

    /**
     * @test
     */
    public function test_update_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->create();
        $editedSpecialistArea = SpecialistArea::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/specialist_areas/'.$specialistArea->id,
            $editedSpecialistArea
        );

        $this->assertApiResponse($editedSpecialistArea);
    }

    /**
     * @test
     */
    public function test_delete_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/specialist_areas/'.$specialistArea->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/specialist_areas/'.$specialistArea->id
        );

        $this->response->assertStatus(404);
    }
}
