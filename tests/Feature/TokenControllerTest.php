<?php

namespace Tests\Feature;

use App\Models\Token;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
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

        $payload = [
            'name' => $this->faker->name,
            'company_id'  => $this->faker->company_id,
        ];
        $this->json('post', 'api/insert_token', $payload)
            ->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(
                [
                    'data' => [
                        'id',
                        'company_id',
                        'name',
                        'token',
                        'is_active',
                        'created_at',
                        'updated_at',
                    ]
                ]
            );
        $this->assertDatabaseHas('tokens', $payload);






















//        $token = [
//            'id' => 11,
//            'name' => "xyzcoampany",
//            'company_id' => "2",
//            'token' => "WQS",
//        ];

//        $this->postJson('api/insert_token', [
//            'name' => "farhan_company",
//            'company_id' => 3,
//        ])->assertStatus(201);

//        $response = $this->call('POST','api/insert_token',$token);
//       // dd($response);
//        $response->assertStatus(201);



        //$token = Token::factory()->create();
//        $response = $this->post('/insert_token');
//        $response->assertStatus(422);
    }
}
