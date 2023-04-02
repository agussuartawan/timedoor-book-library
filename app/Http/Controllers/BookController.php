<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function books(Request $request) :View
    {
        $books = $this->filterData($request);
        $limits = array(10, 20, 30, 40, 50, 60, 70, 80, 90, 100);

        return view('book', compact('books', 'limits'));
    }

    public function authors() :View
    {
        $authors = Author::select('authors.*', DB::raw('count(distinct ratings.id) as voter'))
            ->leftJoin('books', 'authors.id', '=', 'books.author_id')
            ->leftJoin('ratings', 'books.id', '=', 'ratings.book_id')
            ->where('ratings.rating', '>', 5)
            ->groupBy('authors.id')
            ->having('voter', '>', 0)
            ->orderByDesc('voter')
            ->limit(10)
            ->get();

        return view('author', compact('authors'));
    }

    public function rating(Request $request) :View 
    {
        $authorId = $request->author_id;
        $authors = Author::select('id', 'name')->get();
        $ratings = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

        $books = $authorId ? Book::where('author_id', $authorId)->get() : [];

        return view('rating', compact('authors', 'books', 'ratings'));
    }

    public function storeRating(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'rating' => 'required'
        ]);
        Rating::create($request->all());
        return to_route('books')->with('success', 'Data has been saved');
    }

    private function filterData($request) :Collection
    {
        $search = $request->search;
        $limit = $request->limit ?? 10;

        $data = Book::with('category', 'author')
            ->selectRaw('books.*, AVG(ratings.rating) as avg_rating, COUNT(ratings.rating) as voter')
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
