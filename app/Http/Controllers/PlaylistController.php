<?php

namespace App\Http\Controllers;

use App\Models\Track;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlaylistController extends Controller
{
    /**
     * Retrieve the playlist for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id = null)
    {
        if ($id) {
            return Playlist::findOrFail($id);
        }

        return Playlist::all();
    }

    /**
     * Retrieve the playlist created by the given user ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function showByUserId($id)
    {
        $playlist = Playlist::where('user_id', $id)->get()->first();
        $tracks = Track::where('playlist_id', $playlist->id)->get();
        return response()->json(['playlist' => $playlist, 'tracks' => $tracks]);
    }

    /**
     * Delete a playlist by id.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Playlist::where('id', $id)->delete();
    }
}