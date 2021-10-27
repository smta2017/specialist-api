<?php namespace Tests\Repositories;

use App\Models\OrderComment;
use App\Repositories\OrderCommentRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderCommentRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderCommentRepository
     */
    protected $orderCommentRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderCommentRepo = \App::make(OrderCommentRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_comment()
    {
        $orderComment = OrderComment::factory()->make()->toArray();

        $createdOrderComment = $this->orderCommentRepo->create($orderComment);

        $createdOrderComment = $createdOrderComment->toArray();
        $this->assertArrayHasKey('id', $createdOrderComment);
        $this->assertNotNull($createdOrderComment['id'], 'Created OrderComment must have id specified');
        $this->assertNotNull(OrderComment::find($createdOrderComment['id']), 'OrderComment with given id must be in DB');
        $this->assertModelData($orderComment, $createdOrderComment);
    }

    /**
     * @test read
     */
    public function test_read_order_comment()
    {
        $orderComment = OrderComment::factory()->create();

        $dbOrderComment = $this->orderCommentRepo->find($orderComment->id);

        $dbOrderComment = $dbOrderComment->toArray();
        $this->assertModelData($orderComment->toArray(), $dbOrderComment);
    }

    /**
     * @test update
     */
    public function test_update_order_comment()
    {
        $orderComment = OrderComment::factory()->create();
        $fakeOrderComment = OrderComment::factory()->make()->toArray();

        $updatedOrderComment = $this->orderCommentRepo->update($fakeOrderComment, $orderComment->id);

        $this->assertModelData($fakeOrderComment, $updatedOrderComment->toArray());
        $dbOrderComment = $this->orderCommentRepo->find($orderComment->id);
        $this->assertModelData($fakeOrderComment, $dbOrderComment->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_comment()
    {
        $orderComment = OrderComment::factory()->create();

        $resp = $this->orderCommentRepo->delete($orderComment->id);

        $this->assertTrue($resp);
        $this->assertNull(OrderComment::find($orderComment->id), 'OrderComment should not exist in DB');
    }
}
