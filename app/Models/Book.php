<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Book",
 *     type="object",
 *     required={"title", "publisher", "author", "genre", "publication", "word_count", "price"},
 *     @OA\Property(property="id", type="integer", format="int64", description="Book ID"),
 *     @OA\Property(property="title", type="string", description="Title of the book"),
 *     @OA\Property(property="publisher", type="string", description="Publisher of the book"),
 *     @OA\Property(property="author", type="string", description="Author of the book"),
 *     @OA\Property(property="genre", type="string", description="Genre of the book"),
 *     @OA\Property(property="publication", type="string", format="date", description="Publication date of the book"),
 *     @OA\Property(property="word_count", type="integer", description="Word count of the book"),
 *     @OA\Property(property="price", type="number", format="float", description="Price of the book")
 * )
 */


class Book extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'publisher',
        'author',
        'genre',
        'publication',
        'word_count',
        'price'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'publication' => 'date',
        'price' => 'decimal:2',
        'word_count' => 'integer'
    ];
}
