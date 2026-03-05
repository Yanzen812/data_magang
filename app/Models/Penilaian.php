<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'id_guru',
        'id_siswa',
        'kedisipinan',
        'kerja_sama',
        'responsibilitas',
        'nilai_akhir',
    ];

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'id_guru', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}

