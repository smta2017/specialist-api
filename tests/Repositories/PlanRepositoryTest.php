<?php namespace Tests\Repositories;

use App\Models\Plan;
use App\Repositories\PlanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class PlanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var PlanRepository
     */
    protected $planRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->planRepo = \App::make(PlanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_plan()
    {
        $plan = Plan::factory()->make()->toArray();

        $createdPlan = $this->planRepo->create($plan);

        $createdPlan = $createdPlan->toArray();
        $this->assertArrayHasKey('id', $createdPlan);
        $this->assertNotNull($createdPlan['id'], 'Created Plan must have id specified');
        $this->assertNotNull(Plan::find($createdPlan['id']), 'Plan with given id must be in DB');
        $this->assertModelData($plan, $createdPlan);
    }

    /**
     * @test read
     */
    public function test_read_plan()
    {
        $plan = Plan::factory()->create();

        $dbPlan = $this->planRepo->find($plan->id);

        $dbPlan = $dbPlan->toArray();
        $this->assertModelData($plan->toArray(), $dbPlan);
    }

    /**
     * @test update
     */
    public function test_update_plan()
    {
        $plan = Plan::factory()->create();
        $fakePlan = Plan::factory()->make()->toArray();

        $updatedPlan = $this->planRepo->update($fakePlan, $plan->id);

        $this->assertModelData($fakePlan, $updatedPlan->toArray());
        $dbPlan = $this->planRepo->find($plan->id);
        $this->assertModelData($fakePlan, $dbPlan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_plan()
    {
        $plan = Plan::factory()->create();

        $resp = $this->planRepo->delete($plan->id);

        $this->assertTrue($resp);
        $this->assertNull(Plan::find($plan->id), 'Plan should not exist in DB');
    }
}
