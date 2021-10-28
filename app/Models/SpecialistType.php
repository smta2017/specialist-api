<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="SpecialistType",
 *      required={"user_id", "special_type_id"},
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="special_type_id",
 *          description="special_type_id",
 *          type="integer",
 *          format="int32"
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
class SpecialistType extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'specialist_types';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'special_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'special_type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|numeric',
        'special_type_id' => 'required|numeric'
    ];

    
    public function SpecialistTypes()
    {
        return $this->hasMany(SpecialistType::class);
    }

     public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
