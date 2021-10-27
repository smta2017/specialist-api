<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrderComment;

class OrderCommentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_comment()
    {
        $orderComment = OrderComment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_comments', $orderComment
        );

        $this->assertApiResponse($orderComment);
    }

    /**
     * @test
     */
    public function test_read_order_comment()
    {
        $orderComment = OrderComment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/order_comments/'.$orderComment->id
        );

        $this->assertApiResponse($orderComment->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_comment()
    {
        $orderComment = OrderComment::factory()->create();
        $editedOrderComment = OrderComment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_comments/'.$orderComment->id,
            $editedOrderComment
        );

        $this->assertApiResponse($editedOrderComment);
    }

    /**
     * @test
     */
    public function test_delete_order_comment()
    {
        $orderComment = OrderComment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_comments/'.$orderComment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_comments/'.$orderComment->id
        );

        $this->response->assertStatus(404);
    }
}
