<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\RequestComment;

class RequestCommentApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_request_comment()
    {
        $requestComment = RequestComment::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/request_comments', $requestComment
        );

        $this->assertApiResponse($requestComment);
    }

    /**
     * @test
     */
    public function test_read_request_comment()
    {
        $requestComment = RequestComment::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/request_comments/'.$requestComment->id
        );

        $this->assertApiResponse($requestComment->toArray());
    }

    /**
     * @test
     */
    public function test_update_request_comment()
    {
        $requestComment = RequestComment::factory()->create();
        $editedRequestComment = RequestComment::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/request_comments/'.$requestComment->id,
            $editedRequestComment
        );

        $this->assertApiResponse($editedRequestComment);
    }

    /**
     * @test
     */
    public function test_delete_request_comment()
    {
        $requestComment = RequestComment::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/request_comments/'.$requestComment->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/request_comments/'.$requestComment->id
        );

        $this->response->assertStatus(404);
    }
}
