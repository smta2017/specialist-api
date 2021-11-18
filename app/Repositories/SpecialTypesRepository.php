<?php

namespace App\Repositories;

use App\Models\SpecialType;
use App\Repositories\BaseRepository;

/**
 * Class SpecialTypeRepository
 * @package App\Repositories
 * @version October 27, 2021, 12:47 am UTC
*/

class SpecialTypeRepository extends BaseRepository
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
        return SpecialType::class;
    }
}
