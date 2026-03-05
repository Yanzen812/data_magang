<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    use HasFactory;

    protected $table = 'pembimbing';

    protected $fillable = [
        'nama_pembimbing',
        'kontak',
        'asal_sekolah',
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_guru', 'id');
    }

    public function suratPengantar()
    {
        return $this->hasMany(Surat_pengantar::class, 'id_pembimbing', 'id');
    }
}

