<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::post('/artists', [ArtistController::class, 'addNewArtist']);
Route::get('/artists/{id}', [ArtistController::class, 'listArtistWithAlbumsAndTracks']);

Route::post('/albums', [AlbumController::class, 'addNewAlbum']);
Route::get('/albums/{name}', [AlbumController::class, 'listAlbumByName']);
Route::delete('/albums/{id}', [AlbumController::class, 'deleteAlbum']);

Route::post('/tracks', [TrackController::class, 'addNewTrack']);
Route::get('/tracks/{name}', [TrackController::class, 'listTrackByName']);
Route::delete('/tracks/{id}', [TrackController::class, 'deleteTrack']);
