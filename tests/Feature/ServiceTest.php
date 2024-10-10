<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JWTAuth; 
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
        $this->token = JWTAuth::fromUser($this->user);
    }

    public function test_can_create_service_for_space()
    {
        $space = Space::factory()->create();

        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/services', [
            'name' => 'Catering',
            'description' => 'Servicio de catering para eventos',
            'price' => 150.00,
            'space_id' => $space->id,
        ]);
        
        $response->assertStatus(201);
        $this->assertDatabaseHas('services', ['name' => 'Catering', 'space_id' => $space->id]);
    }
}
