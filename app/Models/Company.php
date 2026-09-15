<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    public function gamesAsDeveloper(): HasMany
    {
        return $this->hasMany(Game::class, 'developer_company_id');
    }

    public function gamesAsPublisher(): HasMany
    {
        return $this->hasMany(Game::class, 'publisher_company_id');
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? asset('storage/'.$value) : null,
        );
    }
}
