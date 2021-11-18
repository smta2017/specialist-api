<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SpecialType;

class SpecialTypeApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_special_types()
    {
        $SpecialType = SpecialType::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/special_types', $SpecialType
        );

        $this->assertApiResponse($SpecialType);
    }

    /**
     * @test
     */
    public function test_read_special_types()
    {
        $SpecialType = SpecialType::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/special_types/'.$SpecialType->id
        );

        $this->assertApiResponse($SpecialType->toArray());
    }

    /**
     * @test
     */
    public function test_update_special_types()
    {
        $SpecialType = SpecialType::factory()->create();
        $editedSpecialType = SpecialType::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/special_types/'.$SpecialType->id,
            $editedSpecialType
        );

        $this->assertApiResponse($editedSpecialType);
    }

    /**
     * @test
     */
    public function test_delete_special_types()
    {
        $SpecialType = SpecialType::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/special_types/'.$SpecialType->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/special_types/'.$SpecialType->id
        );

        $this->response->assertStatus(404);
    }
}
