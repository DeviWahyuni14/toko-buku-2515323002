<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'publisher_id',
        'title',
        'author_name',
        'price',
        'published_year',
        'stock',
        'cover',
        'author_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }
   
   public function author(): BelongsTo
    {
    return $this->belongsTo(Author::class);
    }

}
