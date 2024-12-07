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
            $query->orderBy('name');
        });
    }

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class);
    }
}
