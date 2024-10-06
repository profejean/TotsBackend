<?php
namespace App\Http\Controllers;

use App\Models\Space;
use App\Http\Requests\StoreSpaceRequest;
use Illuminate\Http\Response;

class SpaceController extends Controller
{
    public function index()
    {
        return Space::all();
    }

    public function store(StoreSpaceRequest $request)
    {
        $space = Space::create($request->validated()); 
        return response()->json($space, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        return Space::findOrFail($id);
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
