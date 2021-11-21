<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="Order",
 *      required={"title", "user_id"},
 *      @SWG\Property(
 *          property="title",
 *          description="title",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="body",
 *          description="body",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="customer_address_id",
 *          description="customer_address_id",
 *          type="integer",
 *          format="int32"
 *      ),
 *      @SWG\Property(
 *          property="status_id",
 *          description="status_id",
 *          type="string",
 *          default="new"
 *      ),
 *      @SWG\Property(
 *          property="special_type_id",
 *          description="special_type_id",
 *          type="integer",
 *          default=1
 *      ),

 * )
 */
class Order extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use SoftDeletes;

    use HasFactory;

    public $table = 'orders';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'body',
        'user_id',
        'order_state_id',
        'customer_address_id',
        'special_type_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'body' => 'string',
        'user_id' => 'integer',
        'status_id' => 'string',
        'customer_address_id' => 'integer',
        'special_type_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'customer_address_id' => 'required',
        'special_type_id' => 'required'
    ];


    public function comments($crud = false)
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="order-comment?order_id=' . urlencode($this->id) . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-comments"></i> ' . trans('backpack::crud.model.comments') . ' </a>';
    }

    public function approv($crud = false)
    {
        if ($this->order_state_id == 1) {
            
            return '<a class="btn btn-sm btn-link" href="/order/active?order_id=' . urlencode($this->id) . '" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-check-circle"></i> ' . trans('backpack::crud.model.accept') . ' </a>';
        }

    }



    public function scopeType($query, $user_type_id = [])
    {
        return $query->whereHas('User', function ($q) use ($user_type_id) {
            $q->whereIn('user_type_id', 1);
        });
    }


    public function CustomerAddress()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function SpecialType()
    {
        return $this->belongsTo(SpecialType::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function OrderState()
    {
        return $this->belongsTo(OrderState::class);
    }



    public function OrderComments()
    {
        return $this->hasMany(OrderComment::class);
    }
}
