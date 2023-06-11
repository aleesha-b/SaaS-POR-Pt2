<?php

namespace App\Http\Controllers\API;

use App\Models\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorAPIController extends ApiBaseController
{
    /**
     * GET authors
     *
     * Return a list of all authors.
     */
    public function index(): JsonResponse
    {
        $authors = Author::paginate(10);
        if (!is_null ($authors) && $authors->count() > 0) {
            return $this->sendResponse(
                $authors,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No authors found");
    }

    /**
     * POST Author.
     *
     * Store a new author record.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = [
            'given_name' => $request['given_name'],
            'family_name' =>$request['family_name'],
            'is_company' => $request['is_company']
        ];
        $results = Author::create($validated);
        if (!is_null($results) && $results->count() > 0) {
            return $this->sendResponse(
                $results,
                "Successfully created author record."
            );
        }
        return $this->sendError("Unable to create author.");
    }

    /**
     * GET Author ID=
     *
     * Return a author with the specified ID.
     *
     */
    public function show(string $id)
    {
        $author = Author::find($id);
        if (isset($author) && $author->count() > 0) {
            return $this->sendResponse(
                $author,
                "Retrieved author successfully."
            );
        }
        return $this->sendError("Author not found.");
    }

    /**
     * UPDATE Author ID=
     *
     * Update the specified author record.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $author = Author::find($id);
        if (!is_null($author)){
            $validated = [
                'given_name' => $request['given_name'] ?? $author['given_name'],
                'family_name' =>$request['family_name'] ?? $author['family_name'],
                'is_company' => $request['is_company'] ?? $author['is_company']
            ];
            $isUpdated = $author->update($validated);
            if ($isUpdated){
                return $this->sendResponse(
                    $author,
                    "Updated successfully."
                );
            }
            return $this->sendError("Unable to update author.");
        }
        return $this->sendError("Unable to find author, update failed.");
    }

    /**
     * DELETE Author ID=
     *
     * Remove the specified author record.
     */
    public function destroy(string $id)
    {
        $author = Author::find($id);
        $results = $author;
        if (!is_null($author) && $author->count() > 0) {
            $deleted = $author->delete();
            if ($deleted){
                return $this->sendResponse(
                    $results,
                    "Deleted successfully."
                );
            }
            return $this->sendError("Unable to delete author.");
        }
        return $this->sendError("Unable to find author, delete failed.");
    }
}
