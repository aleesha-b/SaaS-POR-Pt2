<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'publisher',
        'year_published',
        'edition',
        'isbn_10',
        'isbn_13',
        'height'
    ];

    /**
     * Return the Authors of a book (Many-to-many)
     *
     * @return BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }

    /**
     * Return the Genres of a book (Many-to-many)
     *
     * @return BelongsToMany
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
