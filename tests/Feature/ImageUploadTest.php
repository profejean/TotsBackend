<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use App\Models\SpaceImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_can_upload_image_for_space()
    {
        $space = Space::factory()->create();

        // Subir imagen falsa
        $response = $this->post('/api/spaces/' . $space->id . '/images', [
            'image' => UploadedFile::fake()->image('space-image.jpg'),
        ]);

        $response->assertStatus(201);

        // Verificar que la imagen fue registrada en la base de datos
        $this->assertDatabaseHas('images', ['space_id' => $space->id]);
    }

    public function test_can_get_images_for_space()
    {
        $space = Space::factory()->create();
        SpaceImage::factory()->count(3)->create(['space_id' => $space->id]);

        $response = $this->get('/api/spaces/' . $space->id . '/images');
        $response->assertStatus(200);
        $this->assertCount(3, $response->json());
    }
}
