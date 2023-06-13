<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryList extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'category_lists';

    protected $primaryKey = 'cateogery_id';

    protected $fillable = ['cateogery_id','category_parent_id','book_id','created_at','updated_at','deleted_at'];

    /**
     * Get the booklist that owns the CategoryList
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booklist(): BelongsTo
    {
        return $this->belongsTo(BookList::class);
    }

}
