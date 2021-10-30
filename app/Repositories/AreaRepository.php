<?php

namespace App\Repositories;

use App\Models\Area;
use App\Repositories\BaseRepository;

/**
 * Class AreaRepository
 * @package App\Repositories
 * @version October 30, 2021, 1:48 pm UTC
*/

class AreaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'city_id',
        'area_name_ar',
        'area_name_en'
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
        return Area::class;
    }
}
