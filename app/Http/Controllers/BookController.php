<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        //tasht per filters me kqyr a eshte specifiku a jo
        $filter = $request->input('filter','');

        //if title is not null or empty it will run that function inside it
        $books = Book::when(
            $title,
            fn ($query,$title) => $query->title($title)
        );

        // similar to switch
        $books = match($filter){
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->latest()->withAvgRating()->withReviewsCount(),
        };
        // $books = $books->get();

        $cacheKey = 'books:' . $filter . ':' . $title;
        $books = cache()->remember($cacheKey,3600, fn() => $books->get());

        return view('books.index',['books' => $books]);
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
    // public function show(Book $book)
    public function show(int $id)
    {
        //qekjo bon mu perdor nese kemi shume rdhana qe kan mu ba load perndryshe
        //funksionon ajo poshte kur kemi veq ne kete rast nje book me load
        //return view('books.show',['book' => $book->load(['reviews'])]);
        // return view('books.show',['book' => $book]);

        $cacheKey = 'book:'. $id;
        $book = cache()->remember(
            $cacheKey,
            36000,
            fn()=>
            // to fetch relations together with the model at the same time, e load
            //is useful if you are fetching relations for a model that is already loaded there
            Book::with([
                'reviews' => fn ($query) => $query->latest()
            ])->withAvgRating()->withReviewsCount()->findOrFail($id)
        );
        return view('books.show',['book' => $book]);
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
