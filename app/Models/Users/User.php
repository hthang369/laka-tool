<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $fillableColumns = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'status'
    ];

    public function getFillableColumns()
    {
        return $this->fillableColumns;
    }

    public function logReleases()
    {
        return $this->hasMany(LogRelease::class);
    }

    public function getIsUserSaAttribute()
    {
        return Auth::user()->status == 1 ? true : false;
    }
    public function getHighestRoleAttribute()
    {
        return Auth::user()->roles()->min('role_rank');
    }
}
