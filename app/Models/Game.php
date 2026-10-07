<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'developer_company_id',
        'publisher_company_id',
        'thumbnail',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope('ordered', function ($query) {
            $query->orderBy('title');
        });

        static::saving(function (Game $game) {
            if ($game->isDirty('title') || empty($game->slug)) {
                $game->slug = static::uniqueSlug($game->title, $game->id);
            }
        });
    }

    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'game';
        $slug = $base;
        $i = 2;

        while (static::withoutGlobalScopes()
            ->where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function developer(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'developer_company_id');
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'publisher_company_id');
    }

    protected function thumbnail(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? asset('storage/' . $value) : null,
        );
    }
}
