<?php

namespace App\Repositories;

use App\Models\RequestComment;
use App\Repositories\BaseRepository;

/**
 * Class RequestCommentRepository
 * @package App\Repositories
 * @version October 27, 2021, 2:22 am UTC
*/

class RequestCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'request_id',
        'user_id',
        'body',
        'offer',
        'delivery_date',
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
        return RequestComment::class;
    }
}
