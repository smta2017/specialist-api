<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Plan;

class PlanApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_plan()
    {
        $plan = Plan::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/plans', $plan
        );

        $this->assertApiResponse($plan);
    }

    /**
     * @test
     */
    public function test_read_plan()
    {
        $plan = Plan::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/plans/'.$plan->id
        );

        $this->assertApiResponse($plan->toArray());
    }

    /**
     * @test
     */
    public function test_update_plan()
    {
        $plan = Plan::factory()->create();
        $editedPlan = Plan::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/plans/'.$plan->id,
            $editedPlan
        );

        $this->assertApiResponse($editedPlan);
    }

    /**
     * @test
     */
    public function test_delete_plan()
    {
        $plan = Plan::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/plans/'.$plan->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/plans/'.$plan->id
        );

        $this->response->assertStatus(404);
    }
}
