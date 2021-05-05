<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'role',
        'phone'
    ];

    protected $role;

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

    /**
     * @return HasMany
     */
    public function domains()
    {
        return $this->HasMany(Domain::class);
    }

    public function depts()
    {
        return $this->HasMany(Dept::class);
    }

    public function comments()
    {
        return $this->HasMany(Comment::class);
    }

    public function projets()
    {
        return $this->HasMany(Projet::class);
    }

    public function isRole()
    {
        return $this->role;
    }

    /**
     * @return bool
     * function verify if the user is admin
     */
    public function isAdmin() : bool
    {
        return $this->attributes['role'] === 'admin';
    }

    /**
     * @return bool
     * function verify if the user is accountant
     */
    public function isAccountant() : bool
    {
        return $this->attributes['role'] === 'accountant';
    }

    /**
     * @return bool
     * function verify if the user is user
     */
    public function isUser() : bool
    {
        return $this->attributes['role'] === 'user';
    }

    /**
     * @return bool
     * function verify if the user is client
     */
    public function isCustomer() : bool
    {
        return $this->attributes['customer'] === 'customer';
    }

    /**
     * @return bool
     * function verify if the user is user
     */
    public function isManager() : bool
    {
        return $this->attributes['manager'] === 'manager';
    }

    /**
     * @param mixed $query
     * @return mixed
     */
    public function scopeAdmin($query)
    {
        return $query->where('role','admin');
    }

    /**
     * @param mixed $query
     * @return mixed
     */
    public function scopeAccountant($query)
    {
        return $query->where('role','accountant');
    }

    /**
     * @param mixed $query
     * @return mixed
     */
    public function scopeUser($query)
    {
        return $query->where('role','user');
    }

    /**
     * @param mixed $query
     * @return mixed
     */
    public function scopeCustomer($query)
    {
        return $query->where('role','customer');
    }

    /**
     * @param mixed $query
     * @return mixed
     */
    public function scopeManager($query)
    {
        return $query->where('role','manager');
    }
}
