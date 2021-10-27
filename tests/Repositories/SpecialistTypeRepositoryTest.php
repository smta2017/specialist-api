<?php namespace Tests\Repositories;

use App\Models\SpecialistType;
use App\Repositories\SpecialistTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialistTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialistTypeRepository
     */
    protected $specialistTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialistTypeRepo = \App::make(SpecialistTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_specialist_type()
    {
        $specialistType = SpecialistType::factory()->make()->toArray();

        $createdSpecialistType = $this->specialistTypeRepo->create($specialistType);

        $createdSpecialistType = $createdSpecialistType->toArray();
        $this->assertArrayHasKey('id', $createdSpecialistType);
        $this->assertNotNull($createdSpecialistType['id'], 'Created SpecialistType must have id specified');
        $this->assertNotNull(SpecialistType::find($createdSpecialistType['id']), 'SpecialistType with given id must be in DB');
        $this->assertModelData($specialistType, $createdSpecialistType);
    }

    /**
     * @test read
     */
    public function test_read_specialist_type()
    {
        $specialistType = SpecialistType::factory()->create();

        $dbSpecialistType = $this->specialistTypeRepo->find($specialistType->id);

        $dbSpecialistType = $dbSpecialistType->toArray();
        $this->assertModelData($specialistType->toArray(), $dbSpecialistType);
    }

    /**
     * @test update
     */
    public function test_update_specialist_type()
    {
        $specialistType = SpecialistType::factory()->create();
        $fakeSpecialistType = SpecialistType::factory()->make()->toArray();

        $updatedSpecialistType = $this->specialistTypeRepo->update($fakeSpecialistType, $specialistType->id);

        $this->assertModelData($fakeSpecialistType, $updatedSpecialistType->toArray());
        $dbSpecialistType = $this->specialistTypeRepo->find($specialistType->id);
        $this->assertModelData($fakeSpecialistType, $dbSpecialistType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_specialist_type()
    {
        $specialistType = SpecialistType::factory()->create();

        $resp = $this->specialistTypeRepo->delete($specialistType->id);

        $this->assertTrue($resp);
        $this->assertNull(SpecialistType::find($specialistType->id), 'SpecialistType should not exist in DB');
    }
}
