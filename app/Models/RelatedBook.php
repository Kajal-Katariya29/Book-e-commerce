<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedBook extends Model
{
    use HasFactory;

    protected $table = 'related_books';

    protected $primaryKey = 'related_book_id';

    protected $fillable = ['related_book_id','book_id','created_at','updated_at','deleted_at'];

}
