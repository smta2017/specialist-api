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
 *          property="user_id",
 *          description="user_id",
 *          type="integer",
 *          format="int32"
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
 *          type="string",
 *          default="new"
 *      ),

 * )
 */
class Order extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'orders';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'title',
        'body',
        'user_id',
        'status_id',
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

    



    public function CustomerAddress()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function SpecialistType()
    {
        return $this->belongsTo(SpecialistType::class);
    }
   
    public function User()
    {
        return $this->belongsTo(User::class);
    }


    
    public function OrderComments()
    {
        return $this->hasMany(OrderComment::class);
    }
}