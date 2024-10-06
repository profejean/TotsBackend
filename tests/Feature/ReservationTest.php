<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Space;
use App\Models\Reservation;

class ReservationTest extends TestCase
{
    public function test_user_can_create_reservation()
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        $response = $this->actingAs($user)->post('/api/reservations', [
            'user_id' => $user->id,
            'space_id' => $space->id,
            'start_time' => now(),
            'end_time' => now()->addHours(2),
        ]);

        $response->assertStatus(201);
    }

   
}
