<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryMapping extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'category_mappings';

    protected $primaryKey = 'category_mapping_id';

    protected $fillable = ['category_mapping_id','cateogery_id','book_id','created_at','updated_at','deleted_at'];

    /**
     * Get the category that owns the CategoryMapping
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryList::class, 'cateogery_id', 'cateogery_id');
    }
}
