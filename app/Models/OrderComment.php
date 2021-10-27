<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="OrderComment",
 *      required={"order_id", "user_id", "offer"},
 *      @SWG\Property(
 *          property="order_id",
 *          description="order_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="body",
 *          description="body",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="offer",
 *          description="offer",
 *          type="number",
 *          format="number"
 *      ),
 *      @SWG\Property(
 *          property="delivery_date",
 *          description="delivery_date",
 *          type="string",
 *          format="date"
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
class OrderComment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'order_comments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'user_id',
        'body',
        'offer',
        'delivery_date'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'order_id' => 'integer',
        'user_id' => 'integer',
        'body' => 'string',
        'offer' => 'float',
        'delivery_date' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required numeric',
        'user_id' => 'required numeric',
        'body' => 'reqired',
        'offer' => 'required'
    ];

    
}
