<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTraits;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;
use Illuminate\Notifications\Notifiable;
use App\Policies\BookPolicy;
use Illuminate\Support\Facades\Auth;

class User extends Model implements Authenticatable, CanResetPassword
{
    use HasFactory,SoftDeletes,AuthenticatableTraits,CanResetPasswordTrait,Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'user_id';

    protected $fillable = ['user_id','role','first_name', 'last_name','phone_number','email','password','address','created_at','updated_at','deleted_at'];

    /**
     * Get all of the orders for the User
     */

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get all of the favorite items for the User
     */
    public function favoriteItems(): HasMany
    {
        return $this->hasMany(Favoritetems::class);
    }

    /**
     * Get all of the review for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function review(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users','user_id','role_id');
    }

    public function hasPermission($permissionName)
    {
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('p_name', $permissionName)) {
                return true;
            }
        }
        return false;
    }
}
