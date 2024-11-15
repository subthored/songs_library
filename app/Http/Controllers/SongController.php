<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Song::with('albums')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'album_id' => 'required|integer|exists:albums,id',
            'track_number' => 'required|integer|min:1'
        ]);

        $song = Song::create([
            'name' => $validated['name'],
            'track_number' => $validated['track_number']
        ]);
        $album = Album::findOrFail($validated['album_id']);
        $song->albums()->attach($album, ['track_number' => $validated['track_number']]);

        return response()->json($song, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $song = Song::with('albums')->findOrFail($id);
        return response()->json($song);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'trac_number' => 'integer|min:1'
        ]);

        $song = Song::findOrFail($id);
        $song->update($validated);
        return response()->json($song);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Song::findOrFail($id)->delete();
        return response()->json(['message' => 'Song deleted successfully.']);
    }
}
