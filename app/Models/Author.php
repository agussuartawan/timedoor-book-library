<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory, HasUuids;

    public function books()
    {
        return $this->hasMany(Book::class);
    }

    public function voter()
    {
        $books = $this->books()->get();
        $voter = 0;
        foreach ($books as $book) {
            $voter = $voter + $book->voter();
        }
        
        return $voter;
    }
}
