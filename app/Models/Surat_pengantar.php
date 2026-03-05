<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat_pengantar extends Model
{
    use HasFactory;

    protected $table = 'surat_pengantar';

    protected $fillable = [
        'file',
        'kelompok',
        'id_pembimbing',
        'id_siswa',
        'status',
    ];

    public function pembimbing()
    {
        return $this->belongsTo(Pembimbing::class, 'id_pembimbing', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id');
    }
}

