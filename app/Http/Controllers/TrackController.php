<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TrackController extends Controller
{
    /**
     * Show a track by id.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return Track::findOrFail($id);
    }

    /**
     * Create a track with data from the add track form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $valid = $this->validate($request, [
            'title' => 'required',
            'artist' => 'required',
            'url' => 'required',
            'playlist_id' => 'required'
        ]);

        if ($valid) {
            $track = new Track;

            $track->title = $request->input('title');
            $track->artist = $request->input('artist');
            $track->url = $request->input('url');
            $track->playlist_id = $request->input('playlist_id');

            if ($track->save()) {
                return response()->json(['status' => 'success'], 200);
            }
        }

        return response()->json(['status' => 'fail'], 500);
    }

    /**
     * Update a track with data from the update form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $track = Track::findOrFail($id);

        if ($track) {
            $track->title = $request->input('title');
            $track->artist = $request->input('artist');
            $track->url = $request->input('url');

            if ($track->save()) {
                return response()->json(['status' => 'success'], 200);
            }
        }

        return response()->json(['status' => 'fail'], 500);
    }

    /**
     * Delete a track by id.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Track::where('id', $id)->delete();
    }
}