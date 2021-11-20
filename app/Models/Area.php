<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Area",
 *      required={"city_id", "area_name_ar", "area_name_en"},
 *      @SWG\Property(
 *          property="city_id",
 *          description="city_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="area_name_ar",
 *          description="area_name_ar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="area_name_en",
 *          description="area_name_en",
 *          type="string"
 *      )
 * )
 */
class Area extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public $table = 'areas';
    public $timestamps = false;
    
 


    public $fillable = [
        'city_id',
        'area_name_ar',
        'area_name_en'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'city_id' => 'integer',
        'area_name_ar' => 'string',
        'area_name_en' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'city_id' => 'required|integer',
        'area_name_ar' => 'required|string|max:200',
        'area_name_en' => 'required|string|max:200'
    ];


  public function City()
  {
    return $this->belongsTo(City::class);
  }
}
