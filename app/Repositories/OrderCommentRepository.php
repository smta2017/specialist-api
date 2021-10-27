<?php

namespace App\Repositories;

use App\Models\OrderComment;
use App\Repositories\BaseRepository;

/**
 * Class OrderCommentRepository
 * @package App\Repositories
 * @version October 27, 2021, 3:47 am UTC
*/

class OrderCommentRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'order_id',
        'user_id',
        'body',
        'offer',
        'delivery_date'
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
        return OrderComment::class;
    }
}
