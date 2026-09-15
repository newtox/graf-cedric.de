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

    private const COLOR_MAP = [
        'primary' => '#8b5cf6',
        'secondary' => '#64748b',
        'success' => '#22c55e',
        'warning' => '#f59e0b',
        'danger' => '#ef4444',
        'info' => '#0ea5e9',
        'blue' => '#3b82f6',
        'azure' => '#06b6d4',
        'indigo' => '#6366f1',
        'purple' => '#a855f7',
        'pink' => '#ec4899',
        'red' => '#ef4444',
        'orange' => '#f97316',
        'yellow' => '#eab308',
        'lime' => '#84cc16',
        'green' => '#22c55e',
        'teal' => '#14b8a6',
        'cyan' => '#06b6d4',
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

                return self::COLOR_MAP[strtolower($value)] ?? '#64748b';
            },
        );
    }
}
