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

    public function encounter(): BelongsToMany
    {
        return $this->belongsToMany(Encounter::class);
    }

    protected function casts(): array
    {
        return [
            'title' => 'string',
        ];
    }
}
