<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomController extends Controller
{
    /**
     * Retrieve the room for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id = null)
    {
        if ($id) {
            return Room::findOrFail($id);
        }

        return Room::all();
    }

    /**
     * Retrieve the rooms created by the given user ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function showByUserId($id)
    {
        return Room::where('user_id', $id)->get();
    }

    /**
     * Delete a room by id.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return Room::where('id', $id)->delete();
    }

    /**
     * Create a room with data from create form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // todo
    }

    /**
     * Update a room with data from the update form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        // todo
    }
}