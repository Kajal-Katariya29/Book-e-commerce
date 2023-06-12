<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookList extends Model
{
    use HasFactory;
    protected $table = 'book_lists';
    protected $primaryKey = 'book_id';
    use SoftDeletes;
    protected $fillable = ['book_id','name','description', 'author','price','created_at','updated_at','deleted_at'];
}
