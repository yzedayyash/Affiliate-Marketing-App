<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $referralAccount) {
            $referralAccount->referral_code = self::generateReferralCode();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'referrer_id',
        'image'
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

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = \Hash::make($password);
    }

    public function isAdmin()
    {
        return $this->is_admin == true;
    }

    public static function scopeReferralCodeExists(Builder $query, $referral_code)
    {
        return $query->where('referral_code', $referral_code)
            ->exists();
    }


    protected static function  generateReferralCode()
    {


        do {
            $referral_code = \Str::random(5);
        } while (static::referralCodeExists($referral_code));

        return $referral_code;
    }

    public function referrer()
    {
        return $this->belongsTo('App\Models\User', 'referrer_id', 'id');
    }
    public function referrals()
    {
        return $this->hasMany('App\Models\User', 'referrer_id', 'id');
    }
}
