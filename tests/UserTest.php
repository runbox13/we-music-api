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
            ->seeStatusCode(200)
            ->seeJson([
                'id' => 1
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
            'email' => 'phpunit@gmail.com',
            'password' => 'phpunit'
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
                ]
        ]);
    }

    /**
     * Test PUT /user response.
     *
     * @return void
     */
    public function testUserUpdate()
    {
        $this->json('PUT', '/user/1', [
            'password' => 'password',
            'display_name' => 'Updated Display Name'
        ])
            ->seeStatusCode(200)
            ->seeJson([
                'display_name' => 'Updated Display Name'
        ]);
    }

    /**
     * Test DELETE /user response.
     *
     * @return void
     */
    public function testUserDelete()
    {
        $this->json('DELETE', '/user/11')
            ->seeStatusCode(200);
    }
}
