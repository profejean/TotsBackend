<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Space;
use App\Models\Service;
use App\Models\Reservation;
use App\Models\SpaceImage;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        User::factory(10)->create()->each(function ($user) {
            $spaces = Space::factory(5)->create();

            $spaces->each(function ($space) use ($user) {
                // Crear servicios e imágenes para cada espacio
                Service::factory(3)->create(['space_id' => $space->id]);
                SpaceImage::factory(3)->create(['space_id' => $space->id]);

                // Crear reservaciones solo para algunos espacios
                if ($space->id % 2 == 0) { // Solo espacios con ID par tendrán reservas
                    Reservation::factory(2)->create([
                        'user_id' => $user->id,
                        'space_id' => $space->id,
                        'start_time' => now()->setDate(2024, 11, rand(1, 15))->setTime(rand(8, 16), 0),
                        'end_time' => now()->setDate(2024, 11, rand(16, 30))->setTime(rand(17, 23), 0),
                    ]);
                }
            });
        });
    }
}
