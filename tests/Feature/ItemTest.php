<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ItemTest extends TestCase
{
    public function test_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('api/items/');

        $response->assertStatus(200)
                 ->assertJson([
                     'created' => true,
                 ]);
    }

    /*
    public function test_store()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->post('api/items', ['name' => 'Sally', 'description' => "Aeee"]);

        $response->assertStatus(200);
    }

    public function test_show()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->get('api/items/1');

        $response->assertStatus(200);
    }
    
    public function test_update()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                         ->put('api/items/1', ['name' => 'Sally', 'description' => "Aeee"]);

        $response->assertStatus(200);
    }

    public function test_destroy()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    */
}
