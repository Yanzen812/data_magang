<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanHarian extends Model
{
    use HasFactory;

    protected $table = 'kegiatan_harian';

    protected $fillable = [
        'siswa_id',
        'tanggal',
        'deskripsi_kegiatan',
        'file',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
}

?>