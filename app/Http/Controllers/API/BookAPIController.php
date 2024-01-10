<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
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
            'publisher' => $request['publisher'],
            'year_published' => $request['year_published'],
            'edition' => $request['edition'],
            'isbn_10' => $request['isbn_10'],
            'isbn_13' => $request['isbn_13'],
            'height' => $request['height']
        ];

        if (isset($request['genres'])) {
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
        }
        else{
            return $this->sendError("Unable to create book, missing genres field.");
        }

        $results = Book::create($validated);
        $results->genres()->attach($genresList);

        if (isset($request['authors'])) {
            $authors = explode(',', $validated['authors']);
            $authorsList = [];

            foreach ($authors as $author) {
                $author = trim($author);
                $authorGiven = null;
                $authorFamily = $author;
                $authorFullName = explode(' ', $author);
                if (count($authorFullName) > 1) {
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
            $results->authors()->attach($authorsList);
        }

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
                'publisher' => $request['publisher'] ?? $book['publisher'],
                'year_published' => $request['year_published'] ?? $book['year_published'],
                'edition' => $request['edition'] ?? $book['edition'],
                'isbn_10' => $request['isbn_10'] ?? $book['isbn_10'],
                'isbn_13' => $request['isbn_13'] ?? $book['isbn_13'],
                'height' => $request['height'] ?? $book['height']
            ];
            $isUpdated = $book->update($validated);

            if (!is_null($request['authors'])) {
                $authors = explode(',', $validated['authors']);
                $authorsList = [];

                foreach ($authors as $author) {
                    $author = trim($author);
                    $authorGiven = null;
                    $authorFamily = $author;
                    $authorFullName = explode(' ', $author);
                    if (count($authorFullName) > 1) {
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
                $book->authors()->detach();
                $book->authors()->attach($authorsList);
            }

            if (!is_null($request['genres'])) {
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
                $book->genres()->detach();
                $book->genres()->attach($genresList);
            }
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
