<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'is_admin',
        'name',
        'email',
        'password',
        'avatar',
        'provider',
        'provider_id',
        'token',
        'refresh_token',
        'user_type_id',
        'prefix',
        'first_name',
        'last_name',
        'gender_id',
        'age',
        'center_name',
        'school_name',
        'address_no',
        'village_no',
        'center_phone',
        'school_phone',
        'province_id',
        'district_id',
        'subdistrict_id',
        'zipcode',
        'affiliation_id',
        'affiliation_other',
        'officer_type_id',
        'area_id',
        'position',
        'education_level_id',
        'phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function userType()
    {
        return $this->hasOne(UserType::class, 'id', 'user_type_id');
    }
}
