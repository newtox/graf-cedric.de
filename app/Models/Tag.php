<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
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

    protected function colorHex(): Attribute
    {
        return Attribute::make(
            get: function () {
                $value = trim((string) $this->color);

                if ($value === '') {
                    return '#64748b';
                }

                if (str_starts_with($value, '#')) {
                    return $value;
                }

                if (preg_match('/^[0-9a-fA-F]{6}$/', $value)) {
                    return '#' . $value;
                }

                return '#64748b';
            },
        );
    }
}
