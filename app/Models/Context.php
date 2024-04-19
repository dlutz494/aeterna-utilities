<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
