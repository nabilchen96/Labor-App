<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalLab extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function laboratorium()
    {
        return $this->belongsTo(Laboratorium::class);
    }

    public function user1()
    {
        return $this->belongsTo(User::class, 'id_user_1');
    }

    public function user2()
    {
        return $this->belongsTo(User::class, 'id_user_2');
    }

    public function user3()
    {
        return $this->belongsTo(User::class, 'id_user_3');
    }

    public function user4()
    {
        return $this->belongsTo(User::class, 'id_user_4');
    }

    public function user5()
    {
        return $this->belongsTo(User::class, 'id_user_5');
    }
}
