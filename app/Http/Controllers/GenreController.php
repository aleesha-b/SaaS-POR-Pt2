<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Http\Requests\UpdateGenreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Route;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::paginate(20);
        return view('genres.index', compact(['genres']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGenreRequest $request)
    {

        $exists = Genre::where('name', 'iLIKE', '%' . $request->name . '%' );

        if (!isset($exists)) {
            $genre = Genre::create($request->validated());
            return redirect()->route('genres.index')
                ->with('success', "Genre {$genre->name} created successfully.");
        }
        return redirect()->route('genres.index')->with('error', "Genre already exists.");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $genre = Genre::find($id);
        if (isset($genre)) {
            return view('genres.edit', compact(['genre',]));
        }
        return redirect()->route('genres.index')->with('error', "Unable to edit, genre with id {$id} does not exist.");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGenreRequest $request, Genre $genre)
    {
        foreach ($request->validated() as $validKey => $validValue) {
            $genre[$validKey] = $validValue;
        }

        $genre->save();

        return redirect()->route('genres.index')
            ->with('success', "Genre {$genre->name} updated successfully.");
    }

    /**
     * Verify the removal from storage.
     */
    public function delete(string $id)
    {
        $genre = Genre::find($id);
        if (isset($id)) {
            return view('genres.delete', compact(['genre',]));
        }
        return redirect()->route('genres.index')->with('error', "Unable to delete, genre with id {$id} does not exist.");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();

        return redirect()->route('genres.index')
            ->with('success', "Genre {$genre->name} deleted successfully.");
    }
}
