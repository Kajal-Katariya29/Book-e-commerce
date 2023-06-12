<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Variant extends Model
{
    use HasFactory;
    protected $table = 'variants';
    protected $primaryKey = 'variant_id';
    use SoftDeletes;
    protected $fillable = ['variant_id','variant_type','created_at','updated_at','deleted_at'];
}
