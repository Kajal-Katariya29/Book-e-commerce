<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Model
{
    use HasFactory,SoftDeletes;

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
}
