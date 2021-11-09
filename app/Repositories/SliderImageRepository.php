<?php

namespace App\Repositories;

use App\Models\SliderImage;
use App\Repositories\BaseRepository;

/**
 * Class SliderImageRepository
 * @package App\Repositories
 * @version November 9, 2021, 3:45 am UTC
*/

class SliderImageRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'description',
        'caption',
        'url',
        'image_name',
        'start_date',
        'end_date',
        'is_active',
        'slider_id'
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
        return SliderImage::class;
    }
}
