<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register_user()
    {
        $response = $this->postJson('/api/v1/register',[
            'email'=>'tessd-user@test.com',
            'password'=>'Test1234',
            'password_confirmation'=>'Test1234'
        ]);

        $response->assertStatus(201);
        $response->decodeResponseJson()['data'];


    }
    public function test_register_email_errors(){
        $response = $this->postJson('/api/v1/register',[
            'email'=>'tess-user@test.com',
            'password'=>'Test1234',
            'password_confirmation'=>'Test1234'
        ]);
        $response->assertStatus( 422);
        $response->decodeResponseJson()['errors']['email'];

    }
}
