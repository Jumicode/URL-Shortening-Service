<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Url extends Model
{
    use HasFactory;

    protected $fillable = ['original_url', 'shortened_url'];
    
    public static function generateUniqueShortCode()
    {
        do {
            $shortCode = Str::random(6); 
        } while (self::where('shortened_url', $shortCode)->exists());

        return $shortCode;
    }

}
