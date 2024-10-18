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



  public function show($shortCode)
  {
      
      $url = Url::where('shortened_url', $shortCode)->first();

     
      if (!$url) {
          return response()->json([
              'message' => 'URL not found'
          ], 404);
      }

      
      return response()->json([
          'id' => $url->id,
          'url' => $url->original_url,
          'shortCode' => $url->shortened_url,
          'createdAt' => $url->created_at->toIso8601String(),
          'updatedAt' => $url->updated_at->toIso8601String(),
      ], 200);
  }

  public function update(Request $request, $shortCode)
  {
      // Validar el cuerpo de la solicitud
      $validator = Validator::make($request->all(), [
          'url' => 'required|url',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'message' => 'Bad Request',
              'errors' => $validator->errors()
          ], 400); // Bad Request
      }

      // Buscar la URL por el código corto
      $url = Url::where('shortened_url', $shortCode)->first();

      // Si no se encuentra, devolver un 404
      if (!$url) {
          return response()->json([
              'message' => 'URL not found'
          ], 404); // Not Found
      }

      // Actualizar la URL original con los nuevos datos
      $url->original_url = $request->input('url');
      $url->updated_at = now();
      $url->save();

      // Devolver la respuesta con la URL actualizada
      return response()->json([
          'id' => $url->id,
          'url' => $url->original_url,
          'shortCode' => $url->shortened_url,
          'createdAt' => $url->created_at->toIso8601String(),
          'updatedAt' => $url->updated_at->toIso8601String(),
      ], 200); // OK
  }


}
