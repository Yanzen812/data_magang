<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu_datang')->nullable();
            $table->enum('status', ['h', 'i', 's', 't']);
            $table->string('file')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
        Schema::create('kegiatan_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('deskripsi_kegiatan');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }



    public function down(): void
    {
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('kegiatan_harian');
    }
};
