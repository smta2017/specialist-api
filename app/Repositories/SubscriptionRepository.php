<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Models\Subscription;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

/**
 * Class SubscriptionRepository
 * @package App\Repositories
 * @version October 27, 2021, 4:17 am UTC
 */

class SubscriptionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'plan_id',
        'start_at',
        'end_at',
        'order_count'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Subscription::class;
    }

    public function storeUserSubscribe($id)
    {
        $plan = Plan::findOrFail($id);

        if (
            $plan->can_supscribing_count <= auth()->user()->Subscriptions->where('plan_id', $id)->count()
            && !is_null($plan->can_supscribing_count)
        ) {

            return ['status' => 0, 'msg' => 'out_of_count'];
        }


        if (Subscription::where('user_id', auth()->user()->id)->active()->get()) {
            return ['status' => 0, 'msg' => 'has_active_subscribe'];
        }

        $data =   [
            'user_id' => auth()->user()->id,
            'plan_id' => $plan->id,
            'start_at' => date('Y-m-d'),
            'end_at' => Carbon::now()->addDays($plan->period_in_days),
            'order_count' => $plan->request_counts
        ];

        return ['status' => 1, 'data' => Subscription::create($data)];

    }
}
