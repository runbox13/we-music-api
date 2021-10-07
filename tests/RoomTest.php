<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class RoomTest extends TestCase
{
    /**
     * Test GET /room response.
     *
     * @return void
     */
    public function testRoomShow()
    {
        $this->json('GET', '/room/1')
            ->seeStatusCode(200)
            ->seeJson([
                'id' => 1,
                'name' => 'Pfeyatko\'s room'
        ]);
    }

    /**
     * Test POST /room response.
     *
     * @return void
     */
    public function testRoomStore()
    {
        $this->json('POST', '/room/store', [
            'name' => 'PHPUnit room',
            'description' => 'PHPUnit created this room',
            'userId' => 1
        ])
            ->seeStatusCode(200);
    }

    /**
     * Test PUT /room response.
     *
     * @return void
     */
    public function testRoomUpdate()
    {
        $this->json('PUT', '/room/6', [
            'name' => 'Updated by PHPUnit',
            'description' => 'Updated by PHPUnit'
        ])
            ->seeStatusCode(200)
            ->seeJson([
                'status' => 'success'
        ]);
    }

    /**
     * Test DELETE /room response.
     *
     * @return void
     */
    public function testRoomDelete()
    {
        $this->json('DELETE', '/room/5')
            ->seeStatusCode(200);
    }
}