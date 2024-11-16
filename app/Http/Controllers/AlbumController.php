<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Music Catalog API",
 *     version="1.0.0",
 *     description="API for managing artists, albums, and songs"
 * )
 */

/**
 * @OA\Tag(
 *     name="Albums",
 *     description="API Endpoints for managing albums"
 * )
 */
class AlbumController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/albums",
     *     tags={"Albums"},
     *     summary="Retrieve all albums",
     *     description="Returns a list of all albums",
     *     @OA\Response(
     *         response=200,
     *         description="List of albums",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Album")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Album::with('songs')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/albums",
     *     tags={"Albums"},
     *     summary="Create a new albums",
     *     description="Creates a new album and returns the created album object",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "release_year", "artist_id"},
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 description="Name of the Album",
     *                 example="Best Ever"
     *             ),
     *             @OA\Property(
     *                 property="release_year",
     *                 type="integer",
     *                 description="Year of album release",
     *                 example=1992
     *             ),
     *             @OA\Property(
     *                 property="artist_id",
     *                 type="integer",
     *                 description="Identifier of artist that album belongs to",
     *                 example=1
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Album successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/Album")
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
            'release_year' => 'required|integer',
            'artist_id' => 'required|integer|exists:artists, id'
        ]);

        $album = Album::create($validated);
        return response()->json($album, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/albums/{id}",
     *     tags={"Albums"},
     *     summary="Retrieve an album by ID",
     *     description="Fetches an album by their unique identifier",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the album to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Album object",
     *         @OA\JsonContent(ref="#/components/schemas/Album")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Album not found"
     *     )
     * )
     */
    public function show($id)
    {
        $album = Album::with(['artist', 'songs'])->findOrFail($id);
        return response()->json($album);
    }

    /**
     * @OA\Put(
     *     path="/api/albums/{id}",
     *     tags={"Albums"},
     *     summary="Update an album",
     *     description="Updates an existing album by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the album to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "release_year", "artist_id"},
     *             @OA\Property(
     *                 property="title",
     *                 type="string",
     *                 description="Name of the Album",
     *                 example="Best Ever"
     *             ),
     *             @OA\Property(
     *                 property="release_year",
     *                 type="integer",
     *                 description="Year of album release",
     *                 example=1992
     *             ),
     *             @OA\Property(
     *                 property="artist_id",
     *                 type="integer",
     *                 description="Identifier of artist that album belongs to",
     *                 example=1
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Album successfully updated",
     *         @OA\JsonContent(ref="#/components/schemas/Album")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Album not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'release_year' => 'integer'
        ]);
        $album = Album::findOrFail($id);
        $album->update($validated);
        return response()->json($album);
    }

    /**
     * @OA\Delete(
     *     path="/api/albums/{id}",
     *     tags={"Albums"},
     *     summary="Delete an album",
     *     description="Deletes a album by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the album to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Album successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Album not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        Album::findOrFail($id)->delete();
        return response()->json(['message' => 'Album deleted successfully.']);
    }
}
