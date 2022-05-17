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
            'email'=>'tes-user@test.com',
            'password'=>'Test1234',
            'password_confirmation'=>'Test1234'
        ]);
        $response->assertStatus(201);
        if($response->assertStatus( 422)){
  $rs = $response->getContent();
  dd($res);
            $response->assertJsonFragment([
                "errors"=>["email"=> ["The email has already been taken."]],
                    "message"=>"The given data was invalid."

            ]);

            }

    }
}
