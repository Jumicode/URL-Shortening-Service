<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class UrlController extends Controller
{
    public function store(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'url' => 'required|url'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 400);
        }

        // Crear el código corto y guardar la URL
        $shortCode = Url::generateUniqueShortCode();
        $url = Url::create([
            'original_url' => $request->input('url'),
            'shortened_url' => $shortCode,
        ]);

        return response()->json([
            'id' => $url->id,
            'url' => $url->original_url,
            'shortCode' => $url->shortened_url,
            'createdAt' => $url->created_at->toIso8601String(),
            'updatedAt' => $url->updated_at->toIso8601String(),
        ], 201);
    }
}
