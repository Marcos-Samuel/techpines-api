<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AlbumController extends Controller
{
    public function listAllAlbumsById(string $artist_id)
    {
        try {
            $albums = Album::where('artist_id', $artist_id)->get();
            return response()->json($albums);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao buscar albums'], 500);
        }
    }

    public function listAlbumByName($name)
    {
        try {
            $album = Album::where('name', $name)->get();
            return response()->json($album);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=> 'Album não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao buscar albums'], 500);
        }
    }

    public function addNewAlbum(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'artist_id' => 'required|exists:artists,id',
                'release_year' => 'nullable|integer',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $album = new Album();
            $album->name = $request->name;
            $album->artist_id = $request->artist_id;
            $album->release_year = $request->release_year;

            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('albums', 'public');
                $album->image_url = Storage::url($imagePath);
            }

            $album->save();

            return response()->json($album, 201);

        } catch (ValidationException $e) {
            return response()->json(['message'=> $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao adicionar album'], 500);
        }
    }

    public function deleteAlbum(string $id)
    {
        try {
            Album::findOrFail($id)->delete();
            return response()->json(['message' => 'Album deletado com sucesso']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=> 'Album não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao deletar album'], 500);
        }
    }
}
