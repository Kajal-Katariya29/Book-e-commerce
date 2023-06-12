<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariantMapping extends Model
{
    use HasFactory;
    protected $table = 'variant_mappings';
    protected $primaryKey = 'variant_mapping_id';
    use SoftDeletes;
    protected $fillable = ['variant_mapping_id','variant_id','book_id','variant_type','created_at','updated_at','deleted_at'];
}
