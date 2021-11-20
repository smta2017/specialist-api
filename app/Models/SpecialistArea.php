<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @SWG\Definition(
 *      definition="SpecialistArea",
 *      required={"user_id", "area_id"},
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
class SpecialistArea extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use SoftDeletes;

    use HasFactory;

    public $table = 'specialist_areas';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'user_id',
        'area_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function scopeWorkArea($query)
    {
        $user_id = \request('user_id');
        if ($user_id) {
            return $query->where('user_id', \request('user_id'));
        }
    }

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required|numeric',
        'area_id' => 'required|numeric'
    ];

    public function SpecialistAreas()
    {
        return $this->hasMany(SpecialistArea::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
