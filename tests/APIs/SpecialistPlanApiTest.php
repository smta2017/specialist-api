<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SpecialistPlan;

class SpecialistPlanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/specialist_plans', $specialistPlan
        );

        $this->assertApiResponse($specialistPlan);
    }

    /**
     * @test
     */
    public function test_read_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/specialist_plans/'.$specialistPlan->id
        );

        $this->assertApiResponse($specialistPlan->toArray());
    }

    /**
     * @test
     */
    public function test_update_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->create();
        $editedSpecialistPlan = SpecialistPlan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/specialist_plans/'.$specialistPlan->id,
            $editedSpecialistPlan
        );

        $this->assertApiResponse($editedSpecialistPlan);
    }

    /**
     * @test
     */
    public function test_delete_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/specialist_plans/'.$specialistPlan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/specialist_plans/'.$specialistPlan->id
        );

        $this->response->assertStatus(404);
    }
}
