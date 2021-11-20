<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
 * )
 */
class OrderComment extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use SoftDeletes;

    use HasFactory;

    public $table = 'order_comments';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'order_id',
        'user_id',
        'body',
        'offer',
        'delivery_date',
        'selected_at'
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
        'delivery_date' => 'date',
        'selected_at'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'order_id' => 'required|numeric',
        'body' => 'required',
        'offer' => 'required'
    ];


    public function scopeOrderComment($query)
    {
        $order_id= \request('order_id');
        if ($order_id) {
            return $query->where('order_id', \request('order_id'));
        }
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }
}
