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

        if ($playlist) {
            $tracks = Track::where('playlist_id', $playlist->id)->get();
            return response()->json(['playlist' => $playlist, 'tracks' => $tracks]);
        }

        return response()->json([], 200);
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

    /**
     * Create a room with data from create form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $valid = $this->validate($request, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($valid) {
            $playlist = new Playlist;

            $playlist->name = $request->input('name');
            $playlist->description = $request->input('description');
            $playlist->user_id = $request->input('userId');

            if ($playlist->save()) {
                return response()->json(['status' => 'success'], 200);
            }
        }

        return response()->json(['status' => 'fail'], 500);
    }
}
