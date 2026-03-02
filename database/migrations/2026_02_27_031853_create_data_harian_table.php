<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->time('waktu_datang')->nullable();
            $table->enum('status', ['h', 'i', 's', 't']); // Hadir, Izin, Sakit, Terlambat
            $table->string('file')->nullable(); // Surat izin atau bukti
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
        Schema::create('kegiatan_harian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('iduser')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->text('Deskripsi_kegiatan');
            $table->string('file')->nullable(); // Link/File project
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi');
        Schema::dropIfExists('kegiatan_harian');
    }
};
