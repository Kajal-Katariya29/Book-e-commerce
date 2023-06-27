<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'role_id';

    protected $fillable = ['role_id','name','created_at','updated_at','deleted_at'];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions','role_id','permission_id');
    }
}
