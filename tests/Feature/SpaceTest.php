<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use App\Models\SpaceImage;
use App\Models\Service;
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

    public function test_can_create_space_with_relations()
    {
        $space = Space::factory()
            ->has(SpaceImage::factory()->count(3)) // Asegura que Space tiene 3 imágenes
            ->has(Service::factory()->count(2)) // Asegura que Space tiene 2 servicios
            ->create();

        // Verificar que el espacio, imágenes y servicios se crearon correctamente
        $this->assertDatabaseHas('spaces', ['id' => $space->id]);
        $this->assertCount(3, $space->images); // Verifica que tiene 3 imágenes
        $this->assertCount(2, $space->services); // Verifica que tiene 2 servicios
    }

    public function test_can_get_spaces_with_relations()
    {
        $spaces = Space::factory()
            ->has(SpaceImage::factory()->count(3))
            ->has(Service::factory()->count(2))
            ->count(2)
            ->create();

        $response = $this->get('/api/spaces');
        $response->assertStatus(200);
        $this->assertCount(2, $response->json()); // Verifica la cantidad de espacios
    }
}
