<?php

namespace App\Repositories;

use App\Models\SpecialTypes;
use App\Repositories\BaseRepository;

/**
 * Class SpecialTypesRepository
 * @package App\Repositories
 * @version October 27, 2021, 12:47 am UTC
*/

class SpecialTypesRepository extends BaseRepository
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
        return SpecialTypes::class;
    }
}
