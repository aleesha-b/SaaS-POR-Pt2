<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiBaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class UserAPIController extends ApiBaseController
{
    /**
     * GET Users
     *
     * Return a list of all users.
     */
    public function index(): JsonResponse
    {
        $users = User::paginate(3);
        if (!is_null($users) && $users->count()> 0) {
            return $this->sendResponse(
                $users,
                "Retrieved successfully.",
            );
        }
        return $this->sendError("No users found.");
    }

    /**
     * POST User.
     *
     * Not available.
     */
    public function store(Request $request)
    {
        return $this->sendError("Unable to create new user.");
    }

    /**
     * GET User ID=
     *
     * Return a user with the specified ID.
     *
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if (isset($user) && $user->count() > 0){
            return $this->sendResponse(
                $user,
                "Retrieved user successfully."
            );
        }
        return $this->sendError("User not found.");
    }

    /**
     * UPDATE User
     *
     * Not available.
     */
    public function update(Request $request, string $id)
    {
        return $this->sendError("Unable to update user.");
    }

    /**
     * DELETE User
     *
     * Not available.
     */
    public function destroy(string $id)
    {
        return $this->sendError("Unable to delete user.");

    }
}
