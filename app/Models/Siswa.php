<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'kontak',
        'jurusan',
        'kelompok',
        'asal_sekolah',
        'periode',
        'jenis_kelamin',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'siswa_id', 'id');
    }

    public function kegiatanHarian()
    {
        return $this->hasMany(KegiatanHarian::class, 'siswa_id', 'id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_siswa', 'id');
    }

    public function suratPengantar()
    {
        return $this->hasMany(Surat_pengantar::class, 'id_siswa', 'id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'siswa_id', 'id');
    }
}
