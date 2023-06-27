<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'role_user_id';

    protected $fillable = ['role_user_id','role_id','user_id','created_at','updated_at','deleted_at'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id','role_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','user_id');
    }
}
