<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'artist_id', 'release_year'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'album_song')->withPivot('track_number');
    }

}
