<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'author',
        'genre',
        'sub_genre',
        'publisher',
        'year_published',
        'edition',
        'isbn_10',
        'isbn_13',
        'height'
    ];
}
