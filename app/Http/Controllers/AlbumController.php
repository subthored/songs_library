<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Album::with('songs')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'release_year' => 'required|integer',
            'artist_id' => 'required|integer|exists:artists, id'
        ]);

        $album = Album::create($validated);
        return response()->json($album, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $album = Album::with(['artist', 'songs'])->findOrFail($id);
        return response()->json($album);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'year_of_release' => 'integer'
        ]);
        $album = Album::findOrFail($id);
        $album->update($validated);
        return response()->json($album);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Album::findOrFail($id)->delete();
        return response()->json(['message' => 'Album deleted successfully.']);
    }
}
