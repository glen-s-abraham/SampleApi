<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Transformers\UserTransformer;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $dates=['deleted_at'];

    const VERIFIED_USER='1';
    const UNVERIFIED_USER='0';

    const ADMIN_USER='true';
    const REGULAR_USER='false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $transformer=UserTransformer::class;
    protected $table='users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


 

    public function isVerified()
    {
        return $this->verified==self::VERIFIED_USER;
    }

    public function isAdmin()
    {
        return $this->admin==self::ADMIN_USER;
    }

    public static function generateVerificationCode()
    {
        return Str::random(40);
    }
}
