<?php

namespace App\Repositories;

use App\Models\SpecialistPlan;
use App\Repositories\BaseRepository;

/**
 * Class SpecialistPlanRepository
 * @package App\Repositories
 * @version October 27, 2021, 1:52 am UTC
*/

class SpecialistPlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'plan_id'
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
        return SpecialistPlan::class;
    }
}
