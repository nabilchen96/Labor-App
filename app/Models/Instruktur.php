<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruktur extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'keahlian' => 'array', // otomatis casting ke array
    ];

}
