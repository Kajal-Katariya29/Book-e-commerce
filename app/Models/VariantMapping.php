<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VariantMapping extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'variant_mappings';

    protected $primaryKey = 'variant_mapping_id';

    protected $fillable = ['variant_mapping_id','variant_id','book_id','variant_type','created_at','updated_at','deleted_at'];

/**
 * Get the variant that owns the VariantMapping
 *
 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
 */
    public function variantType(): BelongsTo
    {
        return $this->belongsTo(VariantType::class,'variant_type_id','variant_type_id');
    }



    /**
     * Get the bookList that owns the VariantMapping
     */

    public function booklist(): BelongsTo
    {
        return $this->belongsTo(BookList::class,'book_id','book_id');
    }
}
