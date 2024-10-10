<?php
namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImageRequest;

class ImageController extends Controller
{
    public function store(StoreImageRequest $request, $spaceId)
    {
      
        $space = Space::findOrFail($spaceId);

      
        $path = $request->file('image')->store('space-images', 'public');

       
        $image = $space->spaceImages()->create([
            'url' => $path, 
        ]);
       
        return response()->json($image, 201);
    }

    public function index($spaceId)
    {
        $space = Space::findOrFail($spaceId);
        return response()->json($space->images);
    }
}
