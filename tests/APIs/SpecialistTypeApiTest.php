<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SpecialistType;

class SpecialistTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_specialist_type()
    {
        $specialistType = SpecialistType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/specialist_types', $specialistType
        );

        $this->assertApiResponse($specialistType);
    }

    /**
     * @test
     */
    public function test_read_specialist_type()
    {
        $specialistType = SpecialistType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/specialist_types/'.$specialistType->id
        );

        $this->assertApiResponse($specialistType->toArray());
    }

    /**
     * @test
     */
    public function test_update_specialist_type()
    {
        $specialistType = SpecialistType::factory()->create();
        $editedSpecialistType = SpecialistType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/specialist_types/'.$specialistType->id,
            $editedSpecialistType
        );

        $this->assertApiResponse($editedSpecialistType);
    }

    /**
     * @test
     */
    public function test_delete_specialist_type()
    {
        $specialistType = SpecialistType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/specialist_types/'.$specialistType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/specialist_types/'.$specialistType->id
        );

        $this->response->assertStatus(404);
    }
}
