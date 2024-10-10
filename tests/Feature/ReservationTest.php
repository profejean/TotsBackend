<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Space;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use JWTAuth; 

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        
        // Generar el token JWT para el usuario
        $this->token = JWTAuth::fromUser($this->user);
    }

    public function test_user_can_create_reservation_for_space()
    {
        $space = Space::factory()->create();

        // Crear una reserva con autenticación JWT
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])->post('/api/reservations', [
            'user_id' => $this->user->id,
            'space_id' => $space->id,
            'start_time' => now()->setDate(2024, 11, 15),
            'end_time' => now()->setDate(2024, 11, 16),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reservations', [
            'user_id' => $this->user->id,
            'space_id' => $space->id,
        ]);
    }   
}
