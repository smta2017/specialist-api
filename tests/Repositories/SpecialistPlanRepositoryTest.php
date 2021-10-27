<?php namespace Tests\Repositories;

use App\Models\SpecialistPlan;
use App\Repositories\SpecialistPlanRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialistPlanRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialistPlanRepository
     */
    protected $specialistPlanRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialistPlanRepo = \App::make(SpecialistPlanRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->make()->toArray();

        $createdSpecialistPlan = $this->specialistPlanRepo->create($specialistPlan);

        $createdSpecialistPlan = $createdSpecialistPlan->toArray();
        $this->assertArrayHasKey('id', $createdSpecialistPlan);
        $this->assertNotNull($createdSpecialistPlan['id'], 'Created SpecialistPlan must have id specified');
        $this->assertNotNull(SpecialistPlan::find($createdSpecialistPlan['id']), 'SpecialistPlan with given id must be in DB');
        $this->assertModelData($specialistPlan, $createdSpecialistPlan);
    }

    /**
     * @test read
     */
    public function test_read_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->create();

        $dbSpecialistPlan = $this->specialistPlanRepo->find($specialistPlan->id);

        $dbSpecialistPlan = $dbSpecialistPlan->toArray();
        $this->assertModelData($specialistPlan->toArray(), $dbSpecialistPlan);
    }

    /**
     * @test update
     */
    public function test_update_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->create();
        $fakeSpecialistPlan = SpecialistPlan::factory()->make()->toArray();

        $updatedSpecialistPlan = $this->specialistPlanRepo->update($fakeSpecialistPlan, $specialistPlan->id);

        $this->assertModelData($fakeSpecialistPlan, $updatedSpecialistPlan->toArray());
        $dbSpecialistPlan = $this->specialistPlanRepo->find($specialistPlan->id);
        $this->assertModelData($fakeSpecialistPlan, $dbSpecialistPlan->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_specialist_plan()
    {
        $specialistPlan = SpecialistPlan::factory()->create();

        $resp = $this->specialistPlanRepo->delete($specialistPlan->id);

        $this->assertTrue($resp);
        $this->assertNull(SpecialistPlan::find($specialistPlan->id), 'SpecialistPlan should not exist in DB');
    }
}
