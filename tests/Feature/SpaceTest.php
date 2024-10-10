<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use App\Models\SpaceImage;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JWTAuth; // Asegúrate de importar JWTAuth
use Tests\TestCase;

class SpaceTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

        // Genera un token JWT para el usuario
        $this->token = JWTAuth::fromUser($this->user);
    }

    public function test_can_create_space_with_relations()
    {       
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token, 
        ])->post('/api/spaces', [
            'name' => 'Test Space',
            'location' => 'Test Location',
            'capacity' => 50,
            'description' => 'Test Description',          
            'type' => 'office',
            'price' => 1000,
        ]);
        
        $response->assertStatus(201);
        
        $space = Space::latest()->first();
        
        $space->spaceImages()->saveMany(SpaceImage::factory()->count(3)->make());
        $space->services()->saveMany(Service::factory()->count(2)->make());
       
        $this->assertDatabaseHas('spaces', ['id' => $space->id]);        
        
        $this->assertCount(3, $space->spaceImages);
        
        $this->assertCount(2, $space->services);
    }

    public function test_can_get_spaces_with_relations()
    {
        $spaces = Space::factory()
            ->has(SpaceImage::factory()->count(3))
            ->has(Service::factory()->count(2))
            ->count(2)
            ->create();

        // Incluye el token JWT en los headers de la solicitud
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->get('/api/spaces');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json()); // Verifica la cantidad de espacios
    }
}
