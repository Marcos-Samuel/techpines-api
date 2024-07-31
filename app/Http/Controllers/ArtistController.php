<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Artist;
use Exception;
use Illuminate\Routing\Controller;

class ArtistController extends Controller
{
    public function addNewArtist(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $artist = new Artist();
            $artist->name = $request->name;
            $artist->save();

            return response()->json([$artist], 201);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Artista não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }

    }

    public function listArtistWithAlbumsAndTracks($id)
    {
        try {
            $artist = Artist::with('albums.tracks')->findOrFail($id);

            return response()->json($artist, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Artista não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao buscar artista'], 500);
        }
    }
}

