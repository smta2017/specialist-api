<?php namespace Tests\Repositories;

use App\Models\Request;
use App\Repositories\RequestRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RequestRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RequestRepository
     */
    protected $requestRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->requestRepo = \App::make(RequestRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_request()
    {
        $request = Request::factory()->make()->toArray();

        $createdRequest = $this->requestRepo->create($request);

        $createdRequest = $createdRequest->toArray();
        $this->assertArrayHasKey('id', $createdRequest);
        $this->assertNotNull($createdRequest['id'], 'Created Request must have id specified');
        $this->assertNotNull(Request::find($createdRequest['id']), 'Request with given id must be in DB');
        $this->assertModelData($request, $createdRequest);
    }

    /**
     * @test read
     */
    public function test_read_request()
    {
        $request = Request::factory()->create();

        $dbRequest = $this->requestRepo->find($request->id);

        $dbRequest = $dbRequest->toArray();
        $this->assertModelData($request->toArray(), $dbRequest);
    }

    /**
     * @test update
     */
    public function test_update_request()
    {
        $request = Request::factory()->create();
        $fakeRequest = Request::factory()->make()->toArray();

        $updatedRequest = $this->requestRepo->update($fakeRequest, $request->id);

        $this->assertModelData($fakeRequest, $updatedRequest->toArray());
        $dbRequest = $this->requestRepo->find($request->id);
        $this->assertModelData($fakeRequest, $dbRequest->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_request()
    {
        $request = Request::factory()->create();

        $resp = $this->requestRepo->delete($request->id);

        $this->assertTrue($resp);
        $this->assertNull(Request::find($request->id), 'Request should not exist in DB');
    }
}
