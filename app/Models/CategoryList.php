<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryList extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'category_lists';

    protected $primaryKey = 'cateogery_id';

    protected $fillable = ['cateogery_id','category_parent_id','category_name','created_at','updated_at','deleted_at'];

    /**
     * Get all of the categoryMapping for the subCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parentCategory(): HasMany
    {
        return $this->hasMany(CategoryList::class, 'cateogery_id', 'category_parent_id');
    }

    /**
     * Get all of the comments for the CategoryList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childCategory(): HasMany
    {
        return $this->hasMany(CategoryList::class, 'category_parent_id', 'cateogery_id');
    }
}
