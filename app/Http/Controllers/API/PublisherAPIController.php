<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublisherAPIController extends ApiBaseController
{
    /**
     * GET Publishers
     *
     * Return a list of all publishers.
     */
    public function index(): JsonResponse
    {
        $publishers = Publisher::paginate(10);
        if (!is_null ($publishers) && $publishers->count() > 0) {
            return $this->sendResponse(
                $publishers,
                "Retrieved successfully."
            );
        }
        return $this->sendError("No publishers found");
    }

    /**
     * POST Publisher.
     *
     * Store a new publisher record.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = [
            'name' => $request['name'],
            'city' => $request['city'],
            'country_code' => $request['country_code']
        ];
        $results = Publisher::create($validated);
        if (!is_null($results) && $results->count() > 0) {
            return $this->sendResponse(
                $results,
                "Successfully created publisher record."
            );
        }
        return $this->sendError("Unable to create publisher.");
    }

    /**
     * GET Publisher ID=
     *
     * Return a publisher with the specified ID.
     *
     */
    public function show(string $id)
    {
        $publisher = Publisher::find($id);
        if (isset($publisher) && $publisher->count() > 0) {
            return $this->sendResponse(
                $publisher,
                "Retrieved publisher successfully."
            );
        }
        return $this->sendError("Publisher not found.");
    }

    /**
     * UPDATE Publisher ID=
     *
     * Update the specified publisher record.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $publisher = Publisher::find($id);
        if (!is_null($publisher)){
            $validated = [
                'name' => $request['name'] ?? $publisher['name'],
                'city' => $request['city'] ?? $publisher['city'],
                'country_code' => $request['country_code'] ?? $publisher['country_code']
            ];
            $isUpdated = $publisher->update($validated);
            if ($isUpdated){
                return $this->sendResponse(
                    $publisher,
                    "Updated successfully."
                );
            }
            return $this->sendError("Unable to update publisher.");
        }
        return $this->sendError("Unable to find publisher, update failed.");
    }

    /**
     * DELETE Publisher ID=
     *
     * Remove the specified publisher record.
     */
    public function destroy(string $id)
    {
        $publisher = Publisher::find($id);
        $results = $publisher;
        if (!is_null($publisher) && $publisher->count() > 0) {
            $deleted = $publisher->delete();
            if ($deleted){
                return $this->sendResponse(
                    $results,
                    "Deleted successfully."
                );
            }
            return $this->sendError("Unable to delete publisher.");
        }
        return $this->sendError("Unable to find publisher, delete failed.");
    }
}
