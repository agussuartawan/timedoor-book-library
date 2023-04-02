<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function books(Request $request) :View
    {
        $books = $this->filterData($request);
        $limits = array(10, 20, 30, 40, 50, 60, 70, 80, 90, 100);

        return view('book', compact('books', 'limits'));
    }

    public function atuhors() :View
    {
        return view('author');
    }

    public function rating(Request $request) :View 
    {
        $authorId = $request->author_id;
        $authors = Author::select('id', 'name')->get();

        $books = $authorId ? Book::where('author_id', $authorId)->get() : [];

        return view('rating', compact('authors', 'books'));
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'rating' => 'required'
        ]);
        Rating::create($request->all());
        return to_route('books');
    }

    private function filterData($request) :Collection
    {
        $search = $request->search;
        $limit = $request->limit ?? 10;

        $data = Book::with('ratings', 'category', 'author')
            ->selectRaw('books.*, AVG(ratings.rating) as avg_rating')
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id');

        $data->when($search, function($query) use($search){
            return $query->where('title', 'like', '%'.$search.'%')
                ->orWhereHas('author', function ($query) use ($search) {
                    $query->where('name', 'like', '%'.$search.'%');
                });
        });   

        $data = $data->groupBy('books.id')
            ->orderByDesc('avg_rating')
            ->limit($limit)
            ->get();
        
        return $data;
    }
}
