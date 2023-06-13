<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Author;
use App\Models\Book;
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
        $book = Book::create($request->validated());

        $author = $book['author'];
        if (!is_null($author)) {
            if ($comma = mb_strpos($author, ",")) {
                $authorGiven = trim(mb_substr($author, 0, $comma));
                $authorFamily = trim(mb_substr($author, $comma + 1, mb_strlen($author)));
            } else {
                $authorGiven = null;
                $authorFamily = $author;
            }
            $author = Author::whereGivenName($authorGiven)->whereFamilyName($authorFamily)->first();
            if (is_null($author)) {
                $newAuthor = [
                    "given_name" => $authorGiven,
                    "family_name" => $authorFamily,
                ];
                Author::create($newAuthor);
            }
        }

        return redirect()->route('books.index')
            ->with('success', "Book {$book->title} created successfully.");
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
        foreach ($request->validated() as $validKey => $validValue) {
            $book[$validKey] = $validValue;
        }

        $book->save();

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
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', "Book {$book->title} deleted successfully.");
    }
}
