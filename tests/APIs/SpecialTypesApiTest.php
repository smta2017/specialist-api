<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\SpecialTypes;

class SpecialTypesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_special_types()
    {
        $specialTypes = SpecialTypes::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/special_types', $specialTypes
        );

        $this->assertApiResponse($specialTypes);
    }

    /**
     * @test
     */
    public function test_read_special_types()
    {
        $specialTypes = SpecialTypes::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/special_types/'.$specialTypes->id
        );

        $this->assertApiResponse($specialTypes->toArray());
    }

    /**
     * @test
     */
    public function test_update_special_types()
    {
        $specialTypes = SpecialTypes::factory()->create();
        $editedSpecialTypes = SpecialTypes::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/special_types/'.$specialTypes->id,
            $editedSpecialTypes
        );

        $this->assertApiResponse($editedSpecialTypes);
    }

    /**
     * @test
     */
    public function test_delete_special_types()
    {
        $specialTypes = SpecialTypes::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/special_types/'.$specialTypes->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/special_types/'.$specialTypes->id
        );

        $this->response->assertStatus(404);
    }
}
