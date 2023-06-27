<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'permission_id';

    protected $fillable = ['permission_id','p_name','created_at','updated_at','deleted_at'];
}
