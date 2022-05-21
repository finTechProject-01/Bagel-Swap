<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_global_setting_create()
    {
        $response = $this->PostJson('/api/v1/register',[
            'email'=>'settingr@test.com',
            'password'=>'Seest1234',
            'password_confirmation'=>'Seest1234'
        ]);
        $response->assertStatus(201);
        $response->decodeResponseJson()['data'];
        $responseConnect = $this->PostJson('/api/v1/login',[
            'email'=>'settingr@test.com',
            'password'=>'Seest1234',
            ]);
        $responseConnect->assertStatus(200);
        $profile = $this->PostJson('/api/v1/settings',[
            'first_name'=>'myTess',
            'last_name'=>'veryTz'
        ]);
        $profile->assertStatus(201);
    }
   
}
