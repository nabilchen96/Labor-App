<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlatLaboratorium extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class);
    }
}
