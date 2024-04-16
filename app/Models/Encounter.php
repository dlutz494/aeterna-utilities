<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

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

    public function context(): HasOneThrough
    {
        return $this->hasOneThrough(Context::class, Weight::class);
    }

    public function weight(): HasOne
    {
        return $this->hasOne(Weight::class);
    }

    protected function casts(): array
    {
        return [
            'title'       => 'string',
            'description' => 'string',
        ];
    }
}
