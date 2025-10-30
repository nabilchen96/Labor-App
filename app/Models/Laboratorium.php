<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorium extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function alatLaboratorium()
    {
        return $this->hasMany(AlatLab::class);
    }
}
