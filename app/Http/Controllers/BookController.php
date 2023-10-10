<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', '');
        $page = $request->input('page', '');

        $books = Book::when($title, fn ($query) => $query->title($title));

        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth()->paginate(10),
            'popular_last_6months' => $books->popularLast6Months()->paginate(10),
            'highest_rated_last_month' => $books->highestRatedLastMonth()->paginate(10),
            'highest_rated_last_6months' => $books->highestRatedLast6Months()->paginate(10),
            default => $books->latest()->withReviewsCount()->withAvgRating()->paginate(10)
        };

        $cacheKey = "books:{$filter}:{$title}:{$page}";

        $books = cache()->remember($cacheKey, 3600, fn () => $books);

        return view('books.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $cacheKey = 'book:' . $id . ':' . request()->input('page', '');

        $book = Book::findorFail($id);
        $book->setRelation('reviews', $book->reviews()->paginate(10));

        $book = cache()->remember($cacheKey, 3600, fn () => $book);

        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
