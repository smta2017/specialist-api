<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Request;

class RequestApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_request()
    {
        $request = Request::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/requests', $request
        );

        $this->assertApiResponse($request);
    }

    /**
     * @test
     */
    public function test_read_request()
    {
        $request = Request::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/requests/'.$request->id
        );

        $this->assertApiResponse($request->toArray());
    }

    /**
     * @test
     */
    public function test_update_request()
    {
        $request = Request::factory()->create();
        $editedRequest = Request::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/requests/'.$request->id,
            $editedRequest
        );

        $this->assertApiResponse($editedRequest);
    }

    /**
     * @test
     */
    public function test_delete_request()
    {
        $request = Request::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/requests/'.$request->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/requests/'.$request->id
        );

        $this->response->assertStatus(404);
    }
}
