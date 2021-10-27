<?php

namespace App\Repositories;

use App\Models\Request;
use App\Repositories\BaseRepository;

/**
 * Class RequestRepository
 * @package App\Repositories
 * @version October 27, 2021, 2:15 am UTC
*/

class RequestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'user_id'
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
        return Request::class;
    }
}
