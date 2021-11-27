<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Chat",
 *      required={"from_user", "to_user", "msg"},
 *      @SWG\Property(
 *          property="from_user",
 *          description="from_user",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="to_user",
 *          description="to_user",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="msg",
 *          description="msg",
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
class Chat extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'chats';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'from_user',
        'to_user',
        'msg'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'from_user' => 'integer',
        'to_user' => 'integer',
        'msg' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'from_user' => 'required',
        'to_user' => 'required',
        'msg' => 'required'
    ];

    
}
