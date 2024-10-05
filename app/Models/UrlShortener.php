<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlShortener extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'slug',
        'original_url',
    ];

    /**
 * Get the attributes that should be cast.
 *
 * @return array<string, string>
 */
protected function casts(): array
{
    return [
        'last_clicked_at' => 'datetime:Y-m-d'
    ];
}
}
