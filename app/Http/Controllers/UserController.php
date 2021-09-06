<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id = null)
    {
        if ($id) {
            return User::findOrFail($id);
        }

        return User::all();
    }

    /**
     * Delete a user by id.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        return User::where('id', $id)->delete();
    }

    /**
     * Create a user with data from registration form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        if ($request->has('email') && $request->has('password')) {
            $user = new User;

            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->display_name = Str::random(8);
            $user->api_key = base64_encode(Str::random(40));

            if ($user->save()) {
                return response()->json(['user' => User::findOrFail($user->id)], 200);
            }
        }

        return response()->json(['status' => 'fail'], 500);
    }
}