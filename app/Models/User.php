<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    use SoftDeletes;
    protected $fillable = ['user_id','role','first_name', 'last_name','phone_number','email','password','address','created_at','updated_at','deleted_at'];
}
