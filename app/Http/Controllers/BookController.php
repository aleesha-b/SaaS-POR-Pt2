<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(20);
        return view('books.index', compact(['books']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();
        $newBook = [
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'publisher' => $validated['publisher'] ?? null,
            'year_published' => $validated['year_published'] ?? null,
            'edition' => $validated['edition'] ?? null,
            'isbn_10' => $validated['isbn_10'] ?? null,
            'isbn_13' => $validated['isbn_13'] ?? null,
            'height' => $validated['height'] ?? null,
        ];
        $thisBook = Book::create($newBook);
        $authors = explode(',', $validated['authors']);
        $authorsList = [];

        foreach ($authors as $author) {
            $author = trim($author);
            $authorGiven = null;
            $authorFamily = $author;
            $authorFullName = explode(' ', $author);
            if (count($authorFullName) > 1){
                $authorGiven = str_replace(' ' . end($authorFullName), '', $author);
                $authorFamily = end($authorFullName);
            }
            $theAuthor = Author::whereGivenName($authorGiven)->whereFamilyName($authorFamily)->first();
            if (is_null($theAuthor)) {
                $newAuthor = [
                    "given_name" => $authorGiven,
                    "family_name" => $authorFamily,
                ];
                $theAuthor = Author::create($newAuthor);
            }
            $authorsList[] = $theAuthor->id;
        }

        $genres = explode(',', $request['genres']);
        $genresList = [];
        foreach ($genres as $genre) {
            $genre = trim($genre);
            $theGenre = Genre::whereName($genre)->first();
            if (is_null($theGenre)) {
                $newGenre = [
                    "name" => $genre,
                    "description" => null,
                ];
                $theGenre = Genre::create($newGenre);
            }
            $genresList[] = $theGenre->id;
        }
        $thisBook->authors()->attach($authorsList);

        $thisBook->genres()->attach($genresList);

        return redirect()->route('books.index')
            ->with('success', "Book {$thisBook->title} created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        if (isset($book)) {
            return view('books.show', compact(['book',]));
        }
        return redirect()->route('books.index')->with('error', "Unable to locate book with id: {$id}");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::find($id);
        if (isset($book)) {
            return view('books.edit', compact(['book',]));
        }
        return redirect()->route('books.index')->with('error', "Unable to edit, book with id {$id} does not exist");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();
        $book['title'] = $validated['title'] ?? null;
        $book['subtitle'] = $validated['subtitle'] ?? null;
        $book['publisher'] = $validated['publisher'] ?? null;
        $book['year_published'] = $validated['year_published'] ?? null;
        $book['edition'] = $validated['edition'] ?? null;
        $book['isbn_10'] = $validated['isbn_10'] ?? null;
        $book['isbn_13'] = $validated['isbn_13'] ?? null;
        $book['height'] = $validated['height'] ?? null;
        $book->save();

        $authors = explode(',', $validated['authors']);
        $authorsList = [];

        foreach ($authors as $author) {
            $author = trim($author);
            $authorGiven = null;
            $authorFamily = $author;
            $authorFullName = explode(' ', $author);
            if (count($authorFullName) > 1){
                $authorGiven = str_replace(' ' . end($authorFullName), '', $author);
                $authorFamily = end($authorFullName);
            }
            $theAuthor = Author::whereGivenName($authorGiven)->whereFamilyName($authorFamily)->first();
            if (is_null($theAuthor)) {
                $newAuthor = [
                    "given_name" => $authorGiven,
                    "family_name" => $authorFamily,
                ];
                $theAuthor = Author::create($newAuthor);
            }
            $authorsList[] = $theAuthor->id;
        }

        $genres = explode(',', $request['genres']);
        $genresList = [];
        foreach ($genres as $genre) {
            $genre = trim($genre);
            $theGenre = Genre::whereName($genre)->first();
            if (is_null($theGenre)) {
                $newGenre = [
                    "name" => $genre,
                    "description" => null,
                ];
                $theGenre = Genre::create($newGenre);
            }
            $genresList[] = $theGenre->id;
        }

        $book->authors()->detach();
        $book->authors()->attach($authorsList);

        $book->genres()->detach();
        $book->genres()->attach($genresList);

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }

    /**
     * Verify the removal from storage.
     */
    public function delete(string $id)
    {
        $book = Book::find($id);
        if (isset($book)) {
            return view('books.delete', compact(['book',]));
        }
        return redirect()->route('books.index')->with('error', "Unable to delete, book with id {$id} does not exist");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->authors()->detach();
        $book->genres()->detach();
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', "Book {$book->title} deleted successfully.");
    }
}
