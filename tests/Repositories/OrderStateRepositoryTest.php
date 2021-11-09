<?php namespace Tests\Repositories;

use App\Models\OrderState;
use App\Repositories\OrderStateRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class OrderStateRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var OrderStateRepository
     */
    protected $orderStateRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->orderStateRepo = \App::make(OrderStateRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_order_state()
    {
        $orderState = OrderState::factory()->make()->toArray();

        $createdOrderState = $this->orderStateRepo->create($orderState);

        $createdOrderState = $createdOrderState->toArray();
        $this->assertArrayHasKey('id', $createdOrderState);
        $this->assertNotNull($createdOrderState['id'], 'Created OrderState must have id specified');
        $this->assertNotNull(OrderState::find($createdOrderState['id']), 'OrderState with given id must be in DB');
        $this->assertModelData($orderState, $createdOrderState);
    }

    /**
     * @test read
     */
    public function test_read_order_state()
    {
        $orderState = OrderState::factory()->create();

        $dbOrderState = $this->orderStateRepo->find($orderState->id);

        $dbOrderState = $dbOrderState->toArray();
        $this->assertModelData($orderState->toArray(), $dbOrderState);
    }

    /**
     * @test update
     */
    public function test_update_order_state()
    {
        $orderState = OrderState::factory()->create();
        $fakeOrderState = OrderState::factory()->make()->toArray();

        $updatedOrderState = $this->orderStateRepo->update($fakeOrderState, $orderState->id);

        $this->assertModelData($fakeOrderState, $updatedOrderState->toArray());
        $dbOrderState = $this->orderStateRepo->find($orderState->id);
        $this->assertModelData($fakeOrderState, $dbOrderState->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_order_state()
    {
        $orderState = OrderState::factory()->create();

        $resp = $this->orderStateRepo->delete($orderState->id);

        $this->assertTrue($resp);
        $this->assertNull(OrderState::find($orderState->id), 'OrderState should not exist in DB');
    }
}
