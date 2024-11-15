<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Artist::with('albums')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);
        $artist = Artist::create($validated);
        return response()->json($artist, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $artist = Artist::with('albums')->findOrFail($id);
        return response()->json($artist);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $artist = Artist::findOrFail($id);
        $artist->update($validated);
        return response()->json($artist);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Artist::findOrFail($id)->delete();
        return response()->json(['message' => 'Artist deleted successfully.']);
    }
}
