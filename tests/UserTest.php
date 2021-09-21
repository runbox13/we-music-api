<?php

use Illuminate\Support\Str;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{

    /**
     * Test GET /user response.
     *
     * @return void
     */
    public function testUserShow()
    {
        $this->json('GET', '/user/1')
             ->seeJson([
                'id' => 1,
        ]);
    }

    /**
     * Test POST /user response.
     *
     * @return void
     */
    public function testUserStore()
    {
        $this->json('POST', '/user/store', [
            'name' => 'Marshall', 
            'email' => Str::random(8).'@gmail.com',
            'password' => 'password123',
            'display_name' => 'foobarBaz'
            ])
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'user' => [
                    'id',
                    'avatar',
                    'bio',
                    'created_at',
                    'display_name',
                    'email',
                    'api_key',
                    'updated_at'
                ],
        ]);
    }
}
