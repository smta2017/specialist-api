<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="SliderImage",
 *      required={"slider_id"},
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="description",
 *          description="description",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="caption",
 *          description="caption",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="url",
 *          description="url",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="image_name",
 *          description="image_name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="start_date",
 *          description="start_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="end_date",
 *          description="end_date",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="is_active",
 *          description="is_active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="slider_id",
 *          description="slider_id",
 *          type="integer",
 *          format="int32"
 *      )
 * )
 */
class SliderImage extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use SoftDeletes;

    use HasFactory;

    public $table = 'slider_images';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
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
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'caption' => 'string',
        'url' => 'string',
        'image_name' => 'string',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
        'slider_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'start_date' => 'date',
        'end_date' => 'date',
        'slider_id' => 'required'
    ];


    public function scopeSliderImages($query)
    {
        $slider_id= \request('slider_id');
        if ($slider_id) {
            return $query->where('slider_id', \request('slider_id'));
        }
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function Slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
