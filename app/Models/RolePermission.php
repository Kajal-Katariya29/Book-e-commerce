<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'role_permission_id';

    protected $fillable = ['role_permission_id','role_id','permission_id','created_at','updated_at','deleted_at'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id','role_id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id','permission_id');
    }
}
