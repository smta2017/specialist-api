<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Subscription",
 *      required={"user_id", "plan_id"},
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="plan_id",
 *          description="plan_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="start_at",
 *          description="start_at",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="end_at",
 *          description="end_at",
 *          type="string",
 *          format="date"
 *      ),
 *      @SWG\Property(
 *          property="order_count",
 *          description="order_count",
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
class Subscription extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use SoftDeletes;

    use HasFactory;

    public $table = 'subscriptions';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'plan_id',
        'start_at',
        'end_at',
        'order_count'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'plan_id' => 'integer',
        'start_at' => 'date',
        'end_at' => 'date',
        'order_count' => 'integer'
    ];

    public function scopeActive($query)
    {
        return $query->whereDate('end_at', '>=', Carbon::now());
    }
    
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'plan_id' => 'required'
    ];

    public function Plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
