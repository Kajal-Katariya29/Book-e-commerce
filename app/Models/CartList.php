<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartList extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'cart_lists';

    protected $primaryKey = 'cart_list_id';

    protected $fillable = ['cart_list_id','user_id','book_id','variant_type_id','quantity','book_price','created_at','updated_at','deleted_at'];

    /**
     * Get all of the booklist for the CartList
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function books(): HasMany
    {
        return $this->hasMany(BookList::class,'book_id','book_id');
    }

   /**
    * Get the user that owns the CartList
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user(): BelongsTo
   {
       return $this->belongsTo(User::class, 'user_id', 'user_id');
   }

   /**
    * Get all of the variants for the CartList
    *
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
   public function variants(): HasMany
   {
       return $this->hasMany(VariantType::class, 'variant_type_id', 'variant_type_id');
   }
}
