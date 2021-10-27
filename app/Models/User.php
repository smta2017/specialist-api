<?php

namespace App\Models;

use App\Http\Traits\SMSTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements Auditable, MustVerifyEmail, HasMedia
{
    use InteractsWithMedia;
    use HasApiTokens, HasFactory, Notifiable;
    use \OwenIt\Auditing\Auditable;
    use HasRoles;
    use SMSTrait;
    use \Rinvex\Attributes\Traits\Attributable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'facebook_id',
        'goolge_id',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \App\Notifications\VerifyEmail);
    }

    public function sendPhoneVerificationOTP()
    {
        $this->sendOTP($this->phone);
    }

    public function isValidSub()
    {
        return  $this->whereHas('Subscriptions', function ($q) {
            $q->where('start_at', '<', date('Y-m-d'))
                ->where('end_at', '>', date('Y-m-d'))
                ->where('order_count', '>=', $this->OrderComments->count());
        })->count();
    }


    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    /**
     * Scope a query to only include none canceled orders.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAdmin($query)
    {
        return $query->where('is_admin', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function scopeSpecialist($query)
    {
        return $query->where('user_type', 'specialist');
    }

    public function scopeCustomer($query)
    {
        return $query->where('user_type', 'customer');
    }

    public function scopeHasSub($query)
    {
        return $query
            ->whereHas('Subscriptions', function ($q) {
                $q->where('start_at', '<', date('Y-m-d'))
                    ->where('end_at', '>', date('Y-m-d'))
                    ->where('order_count', '>=', $this->OrderComments->count());
            });
    }





    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function Subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }



    public function OrderComments()
    {
        return $this->hasMany(OrderComment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
