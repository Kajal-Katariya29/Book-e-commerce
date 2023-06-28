<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;


class BookList extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'book_lists';

    protected $primaryKey = 'book_id';

    protected $fillable = ['book_id','name','description', 'author','price','created_at','updated_at','deleted_at'];

    /**
     * Get all the media item for the BookList
     */

    public function bookMedia(): HasMany
    {
        return $this->hasMany(BookMedia::class,'book_id','book_id');
    }

    /**
     * Get all of the variants for the BookList
     */

    public function variants(): BelongsToMany
    {
        return $this->belongsToMany(VariantType::class,'variant_mappings','book_id','variant_type_id')->withPivot('book_price','variant_mapping_id')->wherePivot('deleted_at',null);
    }

     /**
     * Get all of the reviews for the book
     */

    public function reviews(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Get all of the categories for the BookList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(CategoryMapping::class, 'book_id', 'book_id');
    }
}
