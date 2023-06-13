<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookMedia extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'book_media';

    protected $primaryKey = 'book_media_id';

    protected $fillable = ['book_media_id','book_id','media_name','created_at','updated_at','deleted_at'];

}
