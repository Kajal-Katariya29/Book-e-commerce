<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FavoriteItems extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'favorite_items';

    protected $primaryKey = 'favorite_item_id';

    protected $fillable = ['favorite_item_id','user_id','book_id','created_at','updated_at','deleted_at'];

    /**
     * Get the user that owns the Favoritetems
     */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
