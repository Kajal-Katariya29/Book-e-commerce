<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantType extends Model
{
    use HasFactory;
    protected $table = 'variant_types';
    protected $primaryKey = 'variant_type_id';
    use SoftDeletes;
    protected $fillable = ['variant_type_id','variant_id','variant_type_name','created_at','updated_at'];
}
