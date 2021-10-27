<?php namespace Tests\Repositories;

use App\Models\SpecialTypes;
use App\Repositories\SpecialTypesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialTypesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialTypesRepository
     */
    protected $specialTypesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->specialTypesRepo = \App::make(SpecialTypesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_special_types()
    {
        $specialTypes = SpecialTypes::factory()->make()->toArray();

        $createdSpecialTypes = $this->specialTypesRepo->create($specialTypes);

        $createdSpecialTypes = $createdSpecialTypes->toArray();
        $this->assertArrayHasKey('id', $createdSpecialTypes);
        $this->assertNotNull($createdSpecialTypes['id'], 'Created SpecialTypes must have id specified');
        $this->assertNotNull(SpecialTypes::find($createdSpecialTypes['id']), 'SpecialTypes with given id must be in DB');
        $this->assertModelData($specialTypes, $createdSpecialTypes);
    }

    /**
     * @test read
     */
    public function test_read_special_types()
    {
        $specialTypes = SpecialTypes::factory()->create();

        $dbSpecialTypes = $this->specialTypesRepo->find($specialTypes->id);

        $dbSpecialTypes = $dbSpecialTypes->toArray();
        $this->assertModelData($specialTypes->toArray(), $dbSpecialTypes);
    }

    /**
     * @test update
     */
    public function test_update_special_types()
    {
        $specialTypes = SpecialTypes::factory()->create();
        $fakeSpecialTypes = SpecialTypes::factory()->make()->toArray();

        $updatedSpecialTypes = $this->specialTypesRepo->update($fakeSpecialTypes, $specialTypes->id);

        $this->assertModelData($fakeSpecialTypes, $updatedSpecialTypes->toArray());
        $dbSpecialTypes = $this->specialTypesRepo->find($specialTypes->id);
        $this->assertModelData($fakeSpecialTypes, $dbSpecialTypes->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_special_types()
    {
        $specialTypes = SpecialTypes::factory()->create();

        $resp = $this->specialTypesRepo->delete($specialTypes->id);

        $this->assertTrue($resp);
        $this->assertNull(SpecialTypes::find($specialTypes->id), 'SpecialTypes should not exist in DB');
    }
}
