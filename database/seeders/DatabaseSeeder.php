<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $this->createUsers();
        $this->createRooms();
        $this->createPlaylists();
        $this->createTracks();
    }

    function createUsers()
    {
        DB::table('users')->insert([
            'email' => 'marshall.anthonys@gmail.com',
            'password' => Hash::make('password'),
            'display_name' => 'pfeeyatko',
            'bio' => 'Lorem ipsum dolor sit amet',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        for ($i = 0; $i < 9; $i++) {
            DB::table('users')->insert([
                'email' => Str::random(8).'@gmail.com',
                'password' => Hash::make('password'),
                'display_name' => Str::random(8),
                'bio' => 'Lorem ipsum dolor sit amet',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }

    function createRooms()
    {
        DB::table('rooms')->insert([
            'name' => 'Pfeyatko\'s room',
            'description' => 'This is a room created by the database seeder!',
            'user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        for ($i = 0; $i < 4; $i++) {
            DB::table('rooms')->insert([
                'name' => Str::random(8),
                'description' => 'This is a room created by the database seeder!',
                'user_id' => rand(1, 8),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }

    function createPlaylists()
    {
        DB::table('playlists')->insert([
            'name' => 'LoFi & Chill',
            'description' => 'This is a playlist created by the database seeder!',
            'user_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        for ($i = 2; $i < 6; $i++) {
            DB::table('playlists')->insert([
                'name' => Str::random(8),
                'description' => 'This is a playlist created by the database seeder!',
                'user_id' => $i,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }

    function createTracks()
    {
        DB::table('tracks')->insert([
            'title' => 'Another Batch (1998) [HQ Remastered]',
            'artist' => 'J Dilla',
            'url' => 'https://www.youtube.com/watch?v=LDPyQP34-2Y',
            'playlist_id' => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);

        for ($i = 2; $i < 6; $i++) {
            DB::table('tracks')->insert([
                'title' => 'Never Gonna Give You Up (Official Music Video)',
                'artist' => 'Rick Astley',
                'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                'playlist_id' => $i,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);
        }
    }
}
