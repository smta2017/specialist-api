<?php

namespace App\Repositories;

use App\Models\CustomerAddress;
use App\Repositories\BaseRepository;

/**
 * Class CustomerAddressRepository
 * @package App\Repositories
 * @version October 27, 2021, 2:08 am UTC
*/

class CustomerAddressRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'area_id',
        'street',
        'is_default',
        'floor_no',
        'build_no',
        'notes'
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
        return CustomerAddress::class;
    }
}
