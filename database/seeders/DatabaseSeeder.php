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

        // dummy users
        for ($i = 0; $i < 15; $i++) {
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
}
