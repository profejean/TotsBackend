<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SpaceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_can_create_space()
    {
        $response = $this->post('/api/spaces', [
            'name' => 'Conference Room',
            'location' => '1st Floor',
            'capacity' => 50,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('spaces', ['name' => 'Conference Room']);
    }

    public function test_can_get_spaces()
    {
        Space::factory()->count(3)->create();

        $response = $this->get('/api/spaces');

        $response->assertStatus(200);
        $this->assertCount(3, $response->json());
    }

    
}
