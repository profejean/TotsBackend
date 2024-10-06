<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Space;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_reservation_for_space()
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        // Crear reserva con fechas específicas
        $response = $this->actingAs($user)->post('/api/reservations', [
            'user_id' => $user->id,
            'space_id' => $space->id,
            'start_time' => now()->setDate(2024, 11, 15),
            'end_time' => now()->setDate(2024, 11, 16),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('reservations', [
            'user_id' => $user->id,
            'space_id' => $space->id,
        ]);
    }

    public function test_can_get_reservations_for_space()
    {
        $space = Space::factory()->create();
        $reservations = Reservation::factory()->count(2)->create(['space_id' => $space->id]);

        $response = $this->get('/api/spaces/' . $space->id . '/reservations');
        $response->assertStatus(200);
        $this->assertCount(2, $response->json());
    }
}
