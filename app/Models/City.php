<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="City",
 *      required={"city_name_ar", "city_name_en", "active"},
 *      @SWG\Property(
 *          property="city_name_ar",
 *          description="city_name_ar",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="city_name_en",
 *          description="city_name_en",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="active",
 *          description="active",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="delivery_fees",
 *          description="delivery_fees",
 *          type="number",
 *          format="number"
 *      )
 * )
 */
class City extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;

    public $table = 'cities';
    public $timestamps = false;


    public $fillable = [
        'city_name_ar',
        'city_name_en',
        'country_id',
        'active',
        'delivery_fees'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'city_name_ar' => 'string',
        'city_name_en' => 'string',
        'active' => 'boolean',
        'delivery_fees' => 'decimal:2'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'city_name_ar' => 'required|string|max:50',
        'city_name_en' => 'required|string|max:50',
        'active' => 'required|boolean',
        'delivery_fees' => 'nullable|numeric'
    ];

    public function Areas()
    {
        return $this->hasMany(Area::class);
    }

    public function Country()
    {
      return $this->belongsTo(Country::class);
    }

}
