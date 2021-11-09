<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\OrderState;

class OrderStateApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_order_state()
    {
        $orderState = OrderState::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/order_states', $orderState
        );

        $this->assertApiResponse($orderState);
    }

    /**
     * @test
     */
    public function test_read_order_state()
    {
        $orderState = OrderState::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/order_states/'.$orderState->id
        );

        $this->assertApiResponse($orderState->toArray());
    }

    /**
     * @test
     */
    public function test_update_order_state()
    {
        $orderState = OrderState::factory()->create();
        $editedOrderState = OrderState::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/order_states/'.$orderState->id,
            $editedOrderState
        );

        $this->assertApiResponse($editedOrderState);
    }

    /**
     * @test
     */
    public function test_delete_order_state()
    {
        $orderState = OrderState::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/order_states/'.$orderState->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/order_states/'.$orderState->id
        );

        $this->response->assertStatus(404);
    }
}
