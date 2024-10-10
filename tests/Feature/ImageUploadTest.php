<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use App\Models\SpaceImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use JWTAuth;

class ImageUploadTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();       
      
        $this->token = JWTAuth::fromUser($this->user);
    }

    public function test_can_upload_image_for_space()
    {
        $space = Space::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/spaces/' . $space->id . '/images', [
            'image' => UploadedFile::fake()->image('space-image.jpg'),
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('space_images', ['space_id' => $space->id]);
    }  
}
