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
        // create a User account for each generated Siswa (role = siswa)
        foreach ($siswa as $s) {
            User::create([
                'username' => 'siswa' . $s->id,
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'siswa_id' => $s->id,
            ]);
        }



        $pembimbing = Pembimbing::factory()->count(5)->create();

        // Assign pembimbing to each siswa first
        $siswa->each(function ($s) use ($pembimbing) {
            $s->update([
                'id_pembimbing' => $pembimbing->random()->id,
            ]);
        });

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

        // Create penilaian using siswa's assigned pembimbing
        $siswa->each(function ($s) {
            Penilaian::factory()->create([
                'id_guru' => $s->id_pembimbing,
                'id_siswa' => $s->id,
            ]);
        });

        $siswa->each(function ($s) use ($pembimbing) {
            Surat_pengantar::factory()->create([
                'id_siswa' => $s->id,
                'id_pembimbing' => $pembimbing->random()->id,
            ]);
        });
    }
}
