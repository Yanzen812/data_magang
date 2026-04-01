<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\KegiatanHarian;
use App\Models\Pembimbing;
use App\Models\Penilaian;
use App\Models\Siswa;
use App\Models\Surat_pengantar;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->admin()->create([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
        ]);

        $siswa = Siswa::factory()->count(15)->create();

        $siswa->each(function ($s) {
            User::factory()->siswa()->create([
                'siswa_id' => $s->id,
            ]);
        });

        $pembimbing = Pembimbing::factory()->count(5)->create();

        $siswa->each(function ($s) {
            Absensi::factory()->count(rand(5, 10))->create([
                'siswa_id' => $s->id,
            ]);
        });

        $siswa->each(function ($s) {
            KegiatanHarian::factory()->count(rand(5, 10))->create([
                'siswa_id' => $s->id,
            ]);
        });

        foreach ($pembimbing as $guru) {
            $randomSiswa = $siswa->random(rand(3, 5));
            foreach ($randomSiswa as $s) {
                Penilaian::factory()->create([
                    'id_guru' => $guru->id,
                    'id_siswa' => $s->id,
                ]);
            }
        }

        $siswa->each(function ($s) use ($pembimbing) {
            Surat_pengantar::factory()->create([
                'id_siswa' => $s->id,
                'id_pembimbing' => $pembimbing->random()->id,
            ]);
        });
    }
}
