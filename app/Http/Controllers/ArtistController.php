<?php

namespace App\Http\Controllers;

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
 *     name="Artists",
 *     description="API Endpoints for managing artists"
 * )
 */
class ArtistController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/artists",
     *     tags={"Artists"},
     *     summary="Retrieve all artists",
     *     description="Returns a list of all artists",
     *     @OA\Response(
     *         response=200,
     *         description="List of artists",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/Artist")
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Artist::with('albums')->get());
    }

    /**
     * @OA\Post(
     *     path="/api/artists",
     *     tags={"Artists"},
     *     summary="Create a new artist",
     *     description="Creates a new artist and returns the created artist object",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Name of the artist",
     *                 example="Pink Floyd"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Artist successfully created",
     *         @OA\JsonContent(ref="#/components/schemas/Artist")
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
            'name' => 'required|string|max:255'
        ]);
        $artist = Artist::create($validated);
        return response()->json($artist, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/artists/{id}",
     *     tags={"Artists"},
     *     summary="Retrieve an artist by ID",
     *     description="Fetches an artist by their unique identifier",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the artist to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Artist object",
     *         @OA\JsonContent(ref="#/components/schemas/Artist")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Artist not found"
     *     )
     * )
     */
    public function show($id)
    {
        $artist = Artist::with('albums')->findOrFail($id);
        return response()->json($artist);
    }

    /**
     * @OA\Put(
     *     path="/api/artists/{id}",
     *     tags={"Artists"},
     *     summary="Update an artist",
     *     description="Updates an existing artist by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the artist to update",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 description="Updated name of the artist",
     *                 example="Queen"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Artist successfully updated",
     *         @OA\JsonContent(ref="#/components/schemas/Artist")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Artist not found"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate(['name' => 'required|string|max:255']);
        $artist = Artist::findOrFail($id);
        $artist->update($validated);
        return response()->json($artist);
    }

    /**
     * @OA\Delete(
     *     path="/api/artists/{id}",
     *     tags={"Artists"},
     *     summary="Delete an artist",
     *     description="Deletes an artist by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the artist to delete",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Artist successfully deleted"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Artist not found"
     *     )
     * )
     */
    public function destroy($id)
    {
        Artist::findOrFail($id)->delete();
        return response()->json(['message' => 'Artist deleted successfully.']);
    }
}
