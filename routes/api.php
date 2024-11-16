<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;

// API Routes

// Artist Routes
Route::get('artists', [ArtistController::class, 'index'])->name('artists.index'); // Получить всех исполнителей
Route::get('artists/{id}', [ArtistController::class, 'show'])->name('artists.show'); // Получить конкретного исполнителя
Route::post('artists', [ArtistController::class, 'store'])->name('artists.store'); // Добавить исполнителя
Route::put('artists/{id}', [ArtistController::class, 'update'])->name('artists.update'); // Обновить исполнителя
Route::delete('artists/{id}', [ArtistController::class, 'destroy'])->name('artists.destroy'); // Удалить исполнителя

// Album Routes
Route::get('albums', [AlbumController::class, 'index'])->name('albums.index'); // Получить все альбомы
Route::get('albums/{id}', [AlbumController::class, 'show'])->name('albums.show'); // Получить конкретный альбом
Route::post('albums', [AlbumController::class, 'store'])->name('albums.store'); // Добавить альбом
Route::put('albums/{id}', [AlbumController::class, 'update'])->name('albums.update'); // Обновить альбом
Route::delete('albums/{id}', [AlbumController::class, 'destroy'])->name('albums.destroy'); // Удалить альбом

// Song Routes
Route::get('songs', [SongController::class, 'index'])->name('songs.index'); // Получить все песни
Route::get('songs/{id}', [SongController::class, 'show'])->name('songs.show'); // Получить конкретную песню
Route::post('songs', [SongController::class, 'store'])->name('songs.store'); // Добавить песню
Route::put('songs/{id}', [SongController::class, 'update'])->name('songs.update'); // Обновить песню
Route::delete('songs/{id}', [SongController::class, 'destroy'])->name('songs.destroy'); // Удалить песню
