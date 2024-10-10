<?php
namespace App\Http\Controllers;

use App\Models\Space;
use App\Http\Requests\StoreSpaceRequest;
use Illuminate\Http\Response;

class SpaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Space::query();

        // Filtrar por tipo de espacio
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filtrar por capacidad
        if ($request->has('capacity')) {
            $query->where('capacity', '>=', $request->input('capacity'));
        }

        // Filtrar por disponibilidad (ejemplo con reservas)
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereDoesntHave('reservations', function($q) use ($request) {
                $q->whereBetween('start_time', [$request->input('start_date'), $request->input('end_date')])
                ->orWhereBetween('end_time', [$request->input('start_date'), $request->input('end_date')]);
            });
        }

        $spaces = $query->get();
        return response()->json($spaces);
    }


    public function store(StoreSpaceRequest $request)
    {
        $space = Space::create($request->validated()); 
        return response()->json($space, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $space = Space::with(['spaceImages', 'services', 'reservations'])->findOrFail($id);

        // Calcular horarios disponibles basado en las reservas
        $available_times = []; // Implementar la lógica para calcular horarios disponibles

        return response()->json([
            'space' => $space,
            'available_times' => $available_times
        ]);
    }



    public function update(StoreSpaceRequest $request, $id) 
    {
        $space = Space::findOrFail($id);
        $space->update($request->validated()); 
        return response()->json($space, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Space::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
