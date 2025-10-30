<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogBookPengecekan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class);
    }

    public function alat_laboratorium()
    {
        return $this->belongsTo(AlatLaboratorium::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
