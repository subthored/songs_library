<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;

/**
 * @OA\Tag(
 *     name="Songs",
 *     description="API Endpoints for managing songs"
 * )
 */
class SongController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/songs",
     *     tags={"Songs"},
     *     summary="Retrieve all songs",
     *     description="Returns a list of all songs",
     *     @OA\Response(
     *         response=200,
     *         description="List of songs",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Song")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Song::with('albums')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/songs",
     *     tags={"Songs"},
     *     summary="Create a new song",
     *     description="Creates a new song and returns the created song object",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "album_id", "track_number"},
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 description="Name of the song",
     *                 example="Imagine"
     *             ),
     *             @OA\Property(
     *                 property="album_id",
     *                 type="integer",
     *                 description="Identifier of album this song belongs to",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="track_number",
     *                 type="integer",
     *                 description="Song index number in album",
     *                 example=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Song successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/Song")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Bad request"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'album_id' => 'required|integer|exists:albums,id',
            'track_number' => 'required|integer|min:1'
        ]);

        $song = Song::create([
            'title' => $validated['title'],
            'track_number' => $validated['track_number']
        ]);
        $album = Album::findOrFail($validated['album_id']);
        $song->albums()->attach($album, ['track_number' => $validated['track_number']]);

        return response()->json($song, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/songs/{id}",
     *     tags={"Songs"},
     *     summary="Retrieve a song by ID",
     *     description="Fetches a song by their unique identifier",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the song to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Song object",
     *         @OA\JsonContent(ref="#/components/schemas/Song")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Song not found"
     *     )
     * )
     */
    public function show($id)
    {
        $song = Song::with('albums')->findOrFail($id);
        return response()->json($song);
    }

    /**
     * @OA\Put(
     *     path="/api/songs/{id}",
     *     tags={"Songs"},
     *     summary="Update a song",
     *     description="Updates an existing song by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the song to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "album_id", "track_number"},
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 description="Name of the song",
     *                 example="Believe"
     *             ),
     *             @OA\Property(
     *                 property="album_id",
     *                 type="integer",
     *                 description="Identifier of album this song belongs to",
     *                 example=2
     *             ),
     *             @OA\Property(
     *                 property="track_number",
     *                 type="integer",
     *                 description="Song index number in album",
     *                 example=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Song successfully updated",
     *         @OA\JsonContent(ref="#/components/schemas/Song")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Song not found"
     *     )
     * )
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
     * @OA\Delete(
     *     path="/api/songs/{id}",
     *     tags={"Songs"},
     *     summary="Delete a song",
     *     description="Deletes a song by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the song to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Song successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Song not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        Song::findOrFail($id)->delete();
        return response()->json(['message' => 'Song deleted successfully.']);
    }
}
