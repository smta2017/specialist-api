<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="CustomerAddress",
 *      required={"user_id", "area_id"},
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="area_id",
 *          description="area_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="street",
 *          description="street",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="is_default",
 *          description="is_default",
 *          type="boolean"
 *      ),
 *      @SWG\Property(
 *          property="floor_no",
 *          description="floor_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="build_no",
 *          description="build_no",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="notes",
 *          description="notes",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="created_at",
 *          description="created_at",
 *          type="string",
 *          format="date-time"
 *      ),
 *      @SWG\Property(
 *          property="updated_at",
 *          description="updated_at",
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */
class CustomerAddress extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'customer_addresses';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'area_id',
        'street',
        'is_default',
        'floor_no',
        'build_no',
        'notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'area_id' => 'integer',
        'street' => 'string',
        'is_default' => 'boolean',
        'floor_no' => 'string',
        'build_no' => 'string',
        'notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required numeric',
        'area_id' => 'required numeric'
    ];

    
}
