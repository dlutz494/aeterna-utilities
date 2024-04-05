<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encounter extends Model
{
    use HasFactory;

    protected $table = 'encounters';

    protected $attributes = [
        'title'       => '',
        'description' => '',
        'location'    => '',
    ];

    protected $fillable = [
        'title',
        'description',
        'location',
    ];

    protected function casts(): array
    {
        return [
            'title'       => 'string',
            'description' => 'string',
            'location'    => 'string',
        ];
    }
}
