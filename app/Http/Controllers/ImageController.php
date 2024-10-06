<?php

namespace App\Http\Controllers;

use App\Models\SpaceImage;
use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Requests\StoreImageRequest;

class ImageController extends Controller
{
    public function store(StoreImageRequest $request, $spaceId)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        $space = Space::findOrFail($spaceId);
        $image = $space->images()->create([
            'url' => $request->url,
        ]);

        return response()->json($image, 201);
    }

    public function index($spaceId)
    {
        $space = Space::findOrFail($spaceId);
        return response()->json($space->images);
    }
}
