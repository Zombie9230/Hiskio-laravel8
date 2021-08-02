<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogErrors extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $casts = [
        'trace'       => 'array',
        'params'      => 'array',
        'header'      => 'array',
    ];
}