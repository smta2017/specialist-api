<?php

namespace App\Repositories;

use App\Models\Plan;
use App\Repositories\BaseRepository;

/**
 * Class PlanRepository
 * @package App\Repositories
 * @version October 27, 2021, 1:33 am UTC
*/

class PlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'price',
        'request_counts'
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
        return Plan::class;
    }
}
