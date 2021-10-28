<?php

namespace App\Repositories;

use App\Models\SpecialistType;
use App\Repositories\BaseRepository;

/**
 * Class SpecialistTypeRepository
 * @package App\Repositories
 * @version October 27, 2021, 1:50 am UTC
*/

class SpecialistTypeRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'special_type_id'
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
        return SpecialistType::class;
    }
}
