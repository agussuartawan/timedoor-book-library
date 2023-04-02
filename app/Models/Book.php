<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Type\Integer;

class Book extends Model
{
    use HasFactory, HasUuids;

    public function author() :BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function averageRating() :float
    {
        return number_format($this->ratings()->avg('rating') ?? 0, 2, '.', ',');
    }

    public function ratings() :HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function voter()
    {
        return count($this->ratings) ?? 0;
    }
}
