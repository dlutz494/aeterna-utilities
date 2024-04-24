<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ContextEncounter extends Model
{
    use HasFactory;

    protected $table = 'context_encounters';

    protected $attributes = [
        'context_id'   => '',
        'encounter_id' => '',
        'weight'       => 0,
    ];

    protected $fillable = [
        'context_id',
        'encounter_id',
        'weight',
    ];

    public function context(): HasOne
    {
        return $this->hasOne(Context::class, 'id', 'context_id');
    }

    public function encounter(): HasOne
    {
        return $this->hasOne(Encounter::class, 'id', 'encounter_id');
    }

    protected function casts(): array
    {
        return [
            'context_id'   => 'integer',
            'encounter_id' => 'integer',
            'weight'       => 'integer',
        ];
    }
}
