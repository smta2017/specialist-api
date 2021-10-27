<?php

namespace App\Repositories;

use App\Models\SpecialistArea;
use App\Repositories\BaseRepository;

/**
 * Class SpecialistAreaRepository
 * @package App\Repositories
 * @version October 27, 2021, 1:44 am UTC
*/

class SpecialistAreaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'area_id'
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
        return SpecialistArea::class;
    }
}
