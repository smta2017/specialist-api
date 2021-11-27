<?php

namespace App\Repositories;

use App\Models\Chat;
use App\Repositories\BaseRepository;

/**
 * Class ChatRepository
 * @package App\Repositories
 * @version November 27, 2021, 1:47 pm UTC
*/

class ChatRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'from_user',
        'to_user',
        'msg'
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
        return Chat::class;
    }
}
