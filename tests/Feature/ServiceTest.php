<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_can_create_service_for_space()
    {
        $space = Space::factory()->create();

        $response = $this->post('/api/services', [
            'name' => 'Catering',
            'description' => 'Servicio de catering para eventos',
            'price' => 150.00,
            'space_id' => $space->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('services', ['name' => 'Catering']);
    }

    public function test_can_get_services_for_space()
    {
        $space = Space::factory()->create();
        Service::factory()->count(3)->create(['space_id' => $space->id]);

        $response = $this->get('/api/spaces/' . $space->id . '/services');
        $response->assertStatus(200);
        $this->assertCount(3, $response->json());
    }
}
