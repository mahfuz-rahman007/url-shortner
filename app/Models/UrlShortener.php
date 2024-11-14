<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrlShortener extends Model
{
    use HasFactory, HasSlug;

    /**
     * The source column for the slug.
     *
     * @var string
     */
    protected $slugSourceColumn = '';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_clicked_at' => 'datetime:Y-m-d',
            'clicks' => 'integer',
            'created_at' => 'datetime:d M Y'
        ];
    }

    /**
     * Get the user that owns the URL.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Unknown'
        ]);
    }
}
