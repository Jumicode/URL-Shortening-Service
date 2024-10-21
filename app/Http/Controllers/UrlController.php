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
      
      $validator = Validator::make($request->all(), [
          'url' => 'required|url',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'message' => 'Bad Request',
              'errors' => $validator->errors()
          ], 400); // Bad Request
      }

     
      $url = Url::where('shortened_url', $shortCode)->first();


      if (!$url) {
          return response()->json([
              'message' => 'URL not found'
          ], 404); // Not Found
      }

      
      $url->original_url = $request->input('url');
      $url->updated_at = now();
      $url->save();

      
      return response()->json([
          'id' => $url->id,
          'url' => $url->original_url,
          'shortCode' => $url->shortened_url,
          'createdAt' => $url->created_at->toIso8601String(),
          'updatedAt' => $url->updated_at->toIso8601String(),
      ], 200); // OK
  }


public function destroy($shortCode)
{
    
    $url = Url::where('shortened_url', $shortCode)->first();

    
    if (!$url) {
        return response()->json([
            'message' => 'URL no encontrada'
        ], 404); // Not Found
    }

    
    $url->delete();

    
    return response()->noContent(); // 204 No Content
}


 public function stats($shortCode)
 {
     
     $url = Url::where('shortened_url', $shortCode)->first();

     
     if (!$url) {
         return response()->json([
             'message' => 'URL no encontrada'
         ], 404); // Not Found
     }

     
     return response()->json([
         'id' => $url->id,
         'url' => $url->original_url,
         'shortCode' => $url->shortened_url,
         'createdAt' => $url->created_at->toIso8601String(),
         'updatedAt' => $url->updated_at->toIso8601String(),
         'accessCount' => $url->access_count, 
     ], 200); // OK
 }

 public function redirectToOriginalUrl($shortCode)
{
   
    $url = Url::where('shortened_url', $shortCode)->first();

    
    if (!$url) {
        return response()->json([
            'message' => 'URL no encontrada'
        ], 404); // Not Found
    }

 
    $url->increment('access_count');


    return redirect($url->original_url);
}
 
}
