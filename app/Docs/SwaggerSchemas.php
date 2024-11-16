<?php

namespace App\Docs;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="Artist",
 *     type="object",
 *     title="Artist",
 *     description="Schema for Artist",
 *     required={"id", "name"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Unique identifier for the artist",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the artist",
 *         example="The Beatles"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Date when the artist was created",
 *         example="2024-11-15T12:00:00Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Date when the artist was last updated",
 *         example="2024-11-15T12:00:00Z"
 *     )
 * )
 */

/**
 * @OA\Schema(
 *     schema="Song",
 *     type="object",
 *     title="Song",
 *     description="Schema for Song",
 *     required={"id", "name", "album_id", "track_number"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Unique identifier of the song",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the song",
 *         example="Imagine"
 *     ),
 *     @OA\Property(
 *         property="album_id",
 *         type="integer",
 *         description="Identifier of album this song belongs to",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="track_number",
 *         type="integer",
 *         description="Song index number in album",
 *         example=1
 *     ),
 *     @OA\Property(
 *          property="created_at",
 *          type="string",
 *          format="date-time",
 *          description="Date when the song was created",
 *          example="2024-11-15T12:00:00Z"
 *      ),
 *     @OA\Property(
 *          property="updated_at",
 *          type="string",
 *          format="date-time",
 *          description="Date when the song was last updated",
 *          example="2024-11-15T12:00:00Z"
 *      )
 * )
 */

/**
 * @OA\Schema(
 *     schema="Album",
 *     type="object",
 *     title="Album",
 *     description="Schema for Album",
 *     required={"id", "title", "release_year", "artist_id"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Unique identifier of the song",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         description="Name of the Album",
 *         example="Best Ever"
 *     ),
 *     @OA\Property(
 *         property="release_year",
 *         type="integer",
 *         description="Year of album release",
 *         example=1992
 *     ),
 *     @OA\Property(
 *         property="artist_id",
 *         type="integer",
 *         description="Identifier of artist that album belongs to",
 *         example=1
 *     ),
 *     @OA\Property(
 *          property="created_at",
 *          type="string",
 *          format="date-time",
 *          description="Date when the album was created",
 *          example="2024-11-15T12:00:00Z"
 *      ),
 *     @OA\Property(
 *          property="updated_at",
 *          type="string",
 *          format="date-time",
 *          description="Date when the album was last updated",
 *          example="2024-11-15T12:00:00Z"
 *      )
 * )
 */
