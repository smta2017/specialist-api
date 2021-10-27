<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="RequestComment",
 *      required={"request_id", "user_id", "body", "offer", "delivery_date"},
 *      @SWG\Property(
 *          property="request_id",
 *          description="request_id",
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
 *          property="user_id",
 *          description="user_id",
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
class RequestComment extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'request_comments';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'request_id',
        'user_id',
        'body',
        'offer',
        'delivery_date',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'request_id' => 'integer',
        'user_id' => 'integer',
        'body' => 'string',
        'offer' => 'float',
        'delivery_date' => 'date',
        'user_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'request_id' => 'required numeric',
        'user_id' => 'required numeric',
        'body' => 'required',
        'offer' => 'required',
        'delivery_date' => 'required'
    ];

    
}
