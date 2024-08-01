<?php

namespace App\Http\Controllers;

use App\Helpers\AudioHelper;
use App\Models\Album;
use App\Models\Track;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class TrackController extends Controller
{
    public function addNewTrack(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'album_id'=> 'required|exists:albums,id',
                'music_url' => 'nullable|file|mimes:mp3,wav,ogg|max:20480'
            ]);

            $track = new Track();
            $track->name = $request->input('name');
            $track->album_id = $request->input('album_id');

            $album = Album::findOrFail($request->input('album_id'));
            $track->album_name = $album->name;


            $track->save();

            return response()->json($track, 200);

        } catch(ValidationException $e){
            return response()->json(['message'=> $e->errors()],422);
        }catch (Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }

    public function listTrackbyName(string $name)
    {
        try {
            $tracks = Track::where('name', 'like', '%' . $name . '%')->get();
            return response()->json($tracks, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=> 'Album não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao buscar musica'], 500);
        }
    }

    public function deleteTrack(string $id)
    {
        try {
            Track::findOrFail($id)->delete();
            return response()->json(['message' => 'Musica deletada com sucesso']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=> 'Musica não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao buscar musica'], 500);
        }
    }
    public function getTracksByAlbumId(string $albumId)
    {
        try {
            $tracks = Track::where('album_id', $albumId)->get();
            return response()->json($tracks);
        } catch (Exception $e) {
            return response()->json(['error' => 'Tracks not found'], 404);
        }
    }

}
