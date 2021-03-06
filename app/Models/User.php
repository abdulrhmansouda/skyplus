<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
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
    protected $guarded = ['id'];

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
    ];

    //helpers
    public function roleText(){
        switch($this->role){
            case (UserRoleEnum::SUPER_ADMIN->value): return "SuperAdmin";
            case (UserRoleEnum::ADMIN->value): return "Admin";
            case (UserRoleEnum::ACCOUNTANT->value): return "Accounatant";
            case (UserRoleEnum::POINT->value): return "Point";
        }
    }
    public function isSuperAdmin()
    {
        return $this->role == UserRoleEnum::SUPER_ADMIN->value;
    }

    public function isAdmin()
    {
        return $this->role == UserRoleEnum::ADMIN->value;
    }

    public function isAccountant()
    {
        return $this->role == UserRoleEnum::ACCOUNTANT->value;
    }

    public function isPoint()
    {
        return $this->role == UserRoleEnum::POINT->value;
    }

    //Relations

    public function super_admin()
    {
        return $this->hasOne(SuperAdmin::class);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function accountant()
    {
        return $this->hasOne(Accountant::class);
    }

    public function point()
    {
        return $this->hasOne(Point::class);
    }

}
