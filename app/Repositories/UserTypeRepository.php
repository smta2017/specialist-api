<?php

namespace App\Repositories;

use App\Models\UserType;
use App\Repositories\BaseRepository;

/**
 * Class UserTypeRepository
 * @package App\Repositories
 * @version November 15, 2021, 11:49 pm UTC
*/

class UserTypeRepository extends BaseRepository
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
        return UserType::class;
    }
}
