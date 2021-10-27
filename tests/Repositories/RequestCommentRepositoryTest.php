<?php namespace Tests\Repositories;

use App\Models\RequestComment;
use App\Repositories\RequestCommentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RequestCommentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RequestCommentRepository
     */
    protected $requestCommentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->requestCommentRepo = \App::make(RequestCommentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_request_comment()
    {
        $requestComment = RequestComment::factory()->make()->toArray();

        $createdRequestComment = $this->requestCommentRepo->create($requestComment);

        $createdRequestComment = $createdRequestComment->toArray();
        $this->assertArrayHasKey('id', $createdRequestComment);
        $this->assertNotNull($createdRequestComment['id'], 'Created RequestComment must have id specified');
        $this->assertNotNull(RequestComment::find($createdRequestComment['id']), 'RequestComment with given id must be in DB');
        $this->assertModelData($requestComment, $createdRequestComment);
    }

    /**
     * @test read
     */
    public function test_read_request_comment()
    {
        $requestComment = RequestComment::factory()->create();

        $dbRequestComment = $this->requestCommentRepo->find($requestComment->id);

        $dbRequestComment = $dbRequestComment->toArray();
        $this->assertModelData($requestComment->toArray(), $dbRequestComment);
    }

    /**
     * @test update
     */
    public function test_update_request_comment()
    {
        $requestComment = RequestComment::factory()->create();
        $fakeRequestComment = RequestComment::factory()->make()->toArray();

        $updatedRequestComment = $this->requestCommentRepo->update($fakeRequestComment, $requestComment->id);

        $this->assertModelData($fakeRequestComment, $updatedRequestComment->toArray());
        $dbRequestComment = $this->requestCommentRepo->find($requestComment->id);
        $this->assertModelData($fakeRequestComment, $dbRequestComment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_request_comment()
    {
        $requestComment = RequestComment::factory()->create();

        $resp = $this->requestCommentRepo->delete($requestComment->id);

        $this->assertTrue($resp);
        $this->assertNull(RequestComment::find($requestComment->id), 'RequestComment should not exist in DB');
    }
}
