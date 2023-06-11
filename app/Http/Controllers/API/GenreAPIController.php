<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreAPIController extends ApiBaseController
{
    /**
     * GET Genres
     *
     * Return a list of all genres.
     */
    public function index(): JsonResponse
    {
        $genres = Genre::all();
        if (!is_null ($genres) && $genres->count() > 0) {
            return $this->sendResponse(
                $genres,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No genres found");
    }

    /**
     * POST Genre.
     *
     * Store a new genre record.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = [
            'name' => $request['name'],
            'description' => $request['description']
        ];
        $results = Genre::create($validated);
        if (!is_null($results) && $results->count() > 0) {
            return $this->sendResponse(
                $results,
                "Successfully created genre record."
            );
        }
        return $this->sendError("Unable to create genre.");
    }

    /**
     * GET Genre ID=
     *
     * Return a genre with the specified ID.
     *
     */
    public function show(string $id)
    {
        $genre = Genre::find($id);
        if (isset($genre) && $genre->count() > 0) {
            return $this->sendResponse(
                $genre,
                "Retrieved genre successfully."
            );
        }
        return $this->sendError("Genre not found.");
    }

    /**
     * UPDATE Genre ID=
     *
     * Update the specified genre record.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $genre = Genre::find($id);
        if (!is_null($genre)){
            $validated = [
                'name' => $request['name'] ?? $genre['name'],
                'description' => $request['description'] ?? $genre['description'],
            ];
            $isUpdated = $genre->update($validated);
            if ($isUpdated){
                return $this->sendResponse(
                    $genre,
                    "Updated successfully."
                );
            }
            return $this->sendError("Unable to update genre.");
        }
        return $this->sendError("Unable to find genre, update failed.");
    }

    /**
     * DELETE Genre ID=
     *
     * Remove the specified genre record.
     */
    public function destroy(string $id)
    {
        $genre = Genre::find($id);
        $results = $genre;
        if (!is_null($genre) && $genre->count() > 0) {
            $deleted = $genre->delete();
            if ($deleted){
                return $this->sendResponse(
                    $results,
                    "Deleted successfully."
                );
            }
            return $this->sendError("Unable to delete genre.");
        }
        return $this->sendError("Unable to find genre, delete failed.");
    }
}
