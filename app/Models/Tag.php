<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color'
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('ordered', function ($query) {
            $query->orderByRaw("
            CASE
                WHEN name LIKE 'Alpha%' THEN 1
                WHEN name LIKE 'Beta%' THEN 2
                WHEN name LIKE 'Games%' THEN 3
                WHEN name LIKE 'Hardware%' THEN 4
                WHEN name LIKE 'Software%' THEN 5
                ELSE 6
            END,
            name ASC
            ");
        });
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }
}
