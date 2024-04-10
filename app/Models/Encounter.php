<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Encounter extends Model
{
    use HasFactory;

    protected $table = 'encounters';

    protected $attributes = [
        'title'       => '',
        'description' => '',
        'context_id'  => '',
    ];

    protected $fillable = [
        'title',
        'description',
        'context_id',
    ];

    public function context(): HasOne
    {
        return $this->hasOne(Context::class, 'id', 'context_id');
    }

    protected function casts(): array
    {
        return [
            'title'       => 'string',
            'description' => 'string',
            'context_id'  => 'integer',
        ];
    }
}
