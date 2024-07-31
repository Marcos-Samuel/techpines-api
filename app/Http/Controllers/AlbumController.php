<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Artist;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AlbumController extends Controller
{
    public function listAlbumByName($name)
    {
        try {
            $albums = Album::where('name', 'like', '%' . $name . '%')
            ->with('tracks')
            ->get();

        if ($albums->isEmpty()) {
            return response()->json(['message' => 'Álbum não encontrado'], 404);
        }
            return response()->json($albums, 200);
        }  catch (Exception $e) {
            return response()->json(['message' => $e] , 500);
        }
    }

    public function addNewAlbum(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'artist_id' => 'required|exists:artists,id',
                'release_year' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $album = new Album();
            $album->name = $request->name;
            $album->artist_id = $request->artist_id;
            $album->release_year = $request->release_year;

            $artist = Artist::findOrFail($request->input('artist_id'));
            $album->artist_name = $artist->name;

            if($request->hasFile('image')){
                $imagePath = $request->file('image')->store('albums', 'public');
                $album->image_url = Storage::url($imagePath);
            }

            $album->save();

            return response()->json($album,201);

        }catch(ValidationException $e){
            return response()->json(['message'=> $e->errors()],422);
        } catch (Exception $e) {
            return response()->json(['message' => $e ], 500);
        }

    }

    public function deleteAlbum(string $id)
    {
        try {
            Album::findOrFail($id)->delete();
            return response()->json(['message' => 'Album deletada com sucesso']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message'=> 'Album não encontrado'], 404);
        } catch (Exception $e) {
            return response()->json(['message' => 'Falha ao buscar albums'], 500);
        }

    }
}
