<?php namespace Tests\Repositories;

use App\Models\SpecialistArea;
use App\Repositories\SpecialistAreaRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialistAreaRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialistAreaRepository
     */
    protected $specialistAreaRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialistAreaRepo = \App::make(SpecialistAreaRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->make()->toArray();

        $createdSpecialistArea = $this->specialistAreaRepo->create($specialistArea);

        $createdSpecialistArea = $createdSpecialistArea->toArray();
        $this->assertArrayHasKey('id', $createdSpecialistArea);
        $this->assertNotNull($createdSpecialistArea['id'], 'Created SpecialistArea must have id specified');
        $this->assertNotNull(SpecialistArea::find($createdSpecialistArea['id']), 'SpecialistArea with given id must be in DB');
        $this->assertModelData($specialistArea, $createdSpecialistArea);
    }

    /**
     * @test read
     */
    public function test_read_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->create();

        $dbSpecialistArea = $this->specialistAreaRepo->find($specialistArea->id);

        $dbSpecialistArea = $dbSpecialistArea->toArray();
        $this->assertModelData($specialistArea->toArray(), $dbSpecialistArea);
    }

    /**
     * @test update
     */
    public function test_update_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->create();
        $fakeSpecialistArea = SpecialistArea::factory()->make()->toArray();

        $updatedSpecialistArea = $this->specialistAreaRepo->update($fakeSpecialistArea, $specialistArea->id);

        $this->assertModelData($fakeSpecialistArea, $updatedSpecialistArea->toArray());
        $dbSpecialistArea = $this->specialistAreaRepo->find($specialistArea->id);
        $this->assertModelData($fakeSpecialistArea, $dbSpecialistArea->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_specialist_area()
    {
        $specialistArea = SpecialistArea::factory()->create();

        $resp = $this->specialistAreaRepo->delete($specialistArea->id);

        $this->assertTrue($resp);
        $this->assertNull(SpecialistArea::find($specialistArea->id), 'SpecialistArea should not exist in DB');
    }
}
