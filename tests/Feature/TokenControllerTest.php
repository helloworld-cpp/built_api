<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TokenControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_create_task(){


//
//        $data = [
//            'company_id' => 1,
//            'name' => 'Farhan_Testine',
//        ];
//
//        $this->json('POST',route('insert_token'),$data)->assertStatus(201);

        $response = $this->post('/insert_token');

        $response->assertStatus(200);
    }
}
