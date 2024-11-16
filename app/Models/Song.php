<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_song')->withPivot('track_number');
    }
}
