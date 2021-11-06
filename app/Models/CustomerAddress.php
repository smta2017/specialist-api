<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="CustomerAddress",
 *      required={"user_id", "area_id"},
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
 *          type="boolean",
 *          default="0"
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
        'area_id' => 'required|numeric',
    ];

        
    public function Orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Area()
    {
        return $this->belongsTo(Area::class);
    }



}
