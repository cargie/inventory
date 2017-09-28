<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, Sluggable, HasRoles {
        hasRole as protected thasRole;
        hasAllRoles as protected thasAllRoles;
        hasPermissionTo as protected thasPermissionTo;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'min:8|required|min:8|confirmed',
    ];

    public function sluggable()
    {
        return [
            'uid' => [
                'source' => 'id',
                'unique' => true,
                'separator' => '-',
                'onUpdate' => true,
                'method' => function ($string, $separator) {
                    return 'SU' . $separator . str_pad($string, 5, '0', STR_PAD_LEFT);
                }
            ],
        ];
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function hasRole($roles) {
        return $this->id == 1 || $this->thasRole($roles);
    }

    public function hasAllRoles($roles) {
        return $this->id == 1 || $this->thasAllRoles($roles);
    }

    public function hasPermissionTo($permission, $guardName = null)
    {
        return $this->id == 1 || $this->thasPermissionTo($permission, $guardName = null);
    }
}
