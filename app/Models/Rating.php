<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'ratings';

    protected $primaryKey = 'rating_id';

    protected $fillable = ['rating_id','user_id','book_id','rating','review','created_at','updated_at','deleted_at'];

    /**
     * Get the user that owns the Rating
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
