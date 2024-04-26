<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Context extends Model
{
    use HasFactory;

    protected $table = 'contexts';

    protected $attributes = [
        'title' => '',
    ];

    protected $fillable = [
        'title',
    ];

    protected static function booted(): void
    {
        static::deleted(function (Context $context) {
            foreach ($context->contextEncounters as $contextEncounter) {
                $contextEncounter->context_id = null;
                $contextEncounter->save();
            }
        });
    }

    public function contextEncounters(): HasMany
    {
        return $this->hasMany(ContextEncounter::class);
    }

    public function encounters(): BelongsToMany
    {
        return $this->belongsToMany(Encounter::class, 'context_encounters');
    }

    protected function casts(): array
    {
        return [
            'title' => 'string',
        ];
    }
}
