<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CartList extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'cart_lists';

    protected $primaryKey = 'cart_list_id';

    protected $fillable = ['cart_list_id','user_id','book_id','created_at','updated_at','deleted_at'];

    /**
     * Get all of the booklist for the CartList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(BookList::class);
    }
}
