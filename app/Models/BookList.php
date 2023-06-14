<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
     * Get all the categoryList for the BookList
     */

    public function categoryList(): HasMany
    {
        return $this->hasMany(CategoryList::class);
    }

    /**
     * Get all of the variants for the BookList
     */

    public function variants(): HasMany
    {
        return $this->hasMany(variant::class);
    }

     /**
     * Get all of the reviews for the book
     */

    public function reviews(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

}
