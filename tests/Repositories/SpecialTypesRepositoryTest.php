<?php namespace Tests\Repositories;

use App\Models\SpecialType;
use App\Repositories\SpecialTypeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class SpecialTypeRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var SpecialTypeRepository
     */
    protected $SpecialTypeRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->SpecialTypeRepo = \App::make(SpecialTypeRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_special_types()
    {
        $SpecialType = SpecialType::factory()->make()->toArray();

        $createdSpecialType = $this->SpecialTypeRepo->create($SpecialType);

        $createdSpecialType = $createdSpecialType->toArray();
        $this->assertArrayHasKey('id', $createdSpecialType);
        $this->assertNotNull($createdSpecialType['id'], 'Created SpecialType must have id specified');
        $this->assertNotNull(SpecialType::find($createdSpecialType['id']), 'SpecialType with given id must be in DB');
        $this->assertModelData($SpecialType, $createdSpecialType);
    }

    /**
     * @test read
     */
    public function test_read_special_types()
    {
        $SpecialType = SpecialType::factory()->create();

        $dbSpecialType = $this->SpecialTypeRepo->find($SpecialType->id);

        $dbSpecialType = $dbSpecialType->toArray();
        $this->assertModelData($SpecialType->toArray(), $dbSpecialType);
    }

    /**
     * @test update
     */
    public function test_update_special_types()
    {
        $SpecialType = SpecialType::factory()->create();
        $fakeSpecialType = SpecialType::factory()->make()->toArray();

        $updatedSpecialType = $this->SpecialTypeRepo->update($fakeSpecialType, $SpecialType->id);

        $this->assertModelData($fakeSpecialType, $updatedSpecialType->toArray());
        $dbSpecialType = $this->SpecialTypeRepo->find($SpecialType->id);
        $this->assertModelData($fakeSpecialType, $dbSpecialType->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_special_types()
    {
        $SpecialType = SpecialType::factory()->create();

        $resp = $this->SpecialTypeRepo->delete($SpecialType->id);

        $this->assertTrue($resp);
        $this->assertNull(SpecialType::find($SpecialType->id), 'SpecialType should not exist in DB');
    }
}
