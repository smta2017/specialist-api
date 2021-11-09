<?php

namespace App\Repositories;

use App\Models\OrderState;
use App\Repositories\BaseRepository;

/**
 * Class OrderStateRepository
 * @package App\Repositories
 * @version November 8, 2021, 11:51 pm UTC
*/

class OrderStateRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
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
        return OrderState::class;
    }
}
