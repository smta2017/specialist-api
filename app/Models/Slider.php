<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Slider",
 *      required={"name", "slider_type"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="slider_type",
 *          description="slider_type",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="slides_per_page",
 *          description="slides_per_page",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="auto_play",
 *          description="auto_play",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="slider_width",
 *          description="slider_width",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="slider_height",
 *          description="slider_height",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_active",
 *          description="is_active",
 *          type="boolean"
 *      ),
 * 
 * )
 */
class Slider extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'sliders';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'slider_type',
        'slides_per_page',
        'auto_play',
        'slider_width',
        'slider_height',
        'is_active'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'slider_type' => 'string',
        'slides_per_page' => 'integer',
        'auto_play' => 'integer',
        'slider_width' => 'string',
        'slider_height' => 'string',
        'is_active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'slider_type' => 'required',
        'auto_play' => 'required'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function SliderImages()
    {
        return $this->hasMany(SliderImage::class);
    }
    
}
