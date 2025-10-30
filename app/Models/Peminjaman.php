<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class);
    }

    public function instruktur()
    {
        return $this->belongsTo(Instruktur::class);
    }
}
