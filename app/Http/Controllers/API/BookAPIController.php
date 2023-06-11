<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookAPIController extends ApiBaseController
{
    /**
     * GET Books
     *
     * Return a list of all books.
     */
    public function index(): JsonResponse
    {
        $books = Book::paginate(20);
        if (!is_null ($books) && $books->count() > 0) {
            return $this->sendResponse(
                $books,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No books found");
    }

    /**
     * POST Book.
     *
     * Store a new book record.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = [
            'title' => $request['title'],
            'subtitle' => $request['subtitle'],
            'author' => $request['author'],
            'genre' => $request['genre'],
            'sub_genre' => $request['sub_genre'],
            'publisher' => $request['publisher'],
            'year_published' => $request['year_published'],
            'edition' => $request['edition'],
            'isbn_10' => $request['isbn_10'],
            'isbn_13' => $request['isbn_13'],
            'height' => $request['height']
        ];
        $author = $validated['author'];
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
        $results = Book::create($validated);
        if (!is_null($results) && $results->count() > 0) {
            return $this->sendResponse(
                $results,
                "Successfully created book record."
            );
        }
        return $this->sendError("Unable to create book.");
    }

    /**
     * GET Book ID=
     *
     * Return a book with the specified ID.
     *
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        if (isset($book) && $book->count() > 0) {
            return $this->sendResponse(
                $book,
                "Retrieved book successfully."
            );
        }
        return $this->sendError("Book not found.");
    }

    /**
     * UPDATE Book ID=
     *
     * Update the specified book record.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $book = Book::find($id);
        if (!is_null($book)){
            $validated = [
                'title' => $request['title'] ?? $book['title'],
                'subtitle' => $request['subtitle'] ?? $book['subtitle'],
                'author' => $request['author'] ?? $book['author'],
                'genre' => $request['genre'] ?? $book['genre'],
                'sub_genre' => $request['sub_genre'] ?? $book['sub_genre'],
                'publisher' => $request['publisher'] ?? $book['publisher'],
                'year_published' => $request['year_published'] ?? $book['year_published'],
                'edition' => $request['edition'] ?? $book['edition'],
                'isbn_10' => $request['isbn_10'] ?? $book['isbn_10'],
                'isbn_13' => $request['isbn_13'] ?? $book['isbn_13'],
                'height' => $request['height'] ?? $book['height']
            ];
            $isUpdated = $book->update($validated);
            if ($isUpdated){
                return $this->sendResponse(
                    $book,
                    "Updated successfully."
                );
            }
            return $this->sendError("Unable to update book.");
        }
        return $this->sendError("Unable to find book, update failed.");
    }

    /**
     * DELETE Book ID=
     *
     * Remove the specified book record.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        $results = $book;
        if (!is_null($book) && $book->count() > 0) {
            $deleted = $book->delete();
            if ($deleted){
                return $this->sendResponse(
                    $results,
                    "Deleted successfully."
                );
            }
            return $this->sendError("Unable to delete book.");
        }
        return $this->sendError("Unable to find book, delete failed.");
    }
}
