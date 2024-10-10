<?php
namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use Illuminate\Http\Response;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::with('space')->get(); // Incluye la relación con Space
    }

    public function store(StoreServiceRequest $request)
    {
        $service = Service::create($request->validated()); // Crea el servicio utilizando datos validados
        return response()->json($service, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return Service::with('space')->findOrFail($id); // Devuelve el servicio con la relación
    }

    public function update(StoreServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated()); // Actualiza el servicio utilizando datos validados
        return response()->json($service, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        Service::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
    
}
