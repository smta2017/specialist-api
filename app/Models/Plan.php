<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Plan",
 *      required={"name", "price", "request_counts"},
 *      @SWG\Property(
 *          property="name",
 *          description="name",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="price",
 *          description="price",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="request_counts",
 *          description="request_counts",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_type",
 *          description="user_type",
 *          type="string",
 *      ),
 *      @SWG\Property(
 *          property="can_supscribing_count",
 *          description="can_supscribing_count",
 *          type="integer",
 *          format="int32"
 *      ),
 *
 * )
 */
class Plan extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'plans';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'price',
        'request_counts',
        'user_type_id',
        'can_supscribing_count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'price' => 'float',
        'request_counts' => 'integer',
        'user_type_id',
        'can_supscribing_count'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'price' => 'required',
        'user_type_id' => 'required',
        'request_counts' => 'required numeric'
    ];

    public function Subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
