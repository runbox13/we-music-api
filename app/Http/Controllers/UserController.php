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
    public function destroy($id)
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

    /**
     * Update a user with data from update profile form.
     *
     * @param  Request  $request
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            $user->email = $request->input('email') ?? $user->email;
            $user->display_name = $request->input('display_name') ?? $user->display_name;
            $user->bio = $request->input('bio') ?? $user->bio;
            $user->avatar = $request->input('avatar') ?? $user->avatar;

            if ($user->save()) {
                return response()->json(['user' => User::findOrFail($user->id)], 200);
            }
        }

        return response()->json(['status' => 'fail'], 500);
    }

    /**
     * Authenticate a user login request.
     *
     * @param  Request  $request
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::where('email', $request->input('email'))->first();
        
        if (Hash::check($request->input('password'), $user->password)) {
            $api_key = base64_encode(Str::random(40));

            User::where('email', $request->input('email'))->update(['api_key' => $api_key]);
            
            return response()->json(['user' => User::where('email', $request->input('email'))->first()], 200);
        }
        
        return response()->json(['status' => 'fail'], 401);
    }
}