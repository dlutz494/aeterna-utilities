<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Encounter extends Model
{
    use HasFactory;

    protected $table = 'encounters';

    protected $attributes = [
        'title'       => '',
        'description' => '',
    ];

    protected $fillable = [
        'title',
        'description',
    ];

    public function getWeightAttribute(): int
    {
        return $this->contextEncounters()->pluck('weight')->first();
    }

    public function getWeightsAttribute(): array
    {
        return $this->contextEncounters()->pluck('weight')->all();
    }

    public function contextEncounters(): HasMany
    {
        return $this->hasMany(ContextEncounter::class);
    }

    public function contexts(): BelongsToMany
    {
        return $this->belongsToMany(Context::class, 'context_encounters');
    }

    protected function casts(): array
    {
        return [
            'title'       => 'string',
            'description' => 'string',
        ];
    }
}
