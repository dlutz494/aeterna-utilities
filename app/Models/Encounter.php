<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    protected static function booted(): void
    {
        static::deleting(function ($encounter) {
            $encounter->weight()->delete();
        });
    }

    public function contextEncounter(): HasOne
    {
        return $this->hasOne(ContextEncounter::class);
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
