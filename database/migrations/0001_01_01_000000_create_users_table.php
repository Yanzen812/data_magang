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
        // Database: users (Gabungan profil & login)
Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('password');
            $table->enum('role', ['admin', 'siswa'])->default('siswa');
            $table->string('kontak')->nullable();
            $table->string('asal_sekolah')->nullable(); // Asal sekolah/kampus
            $table->string('jurusan')->nullable(); // Jurusan
            $table->string('periode')->nullable(); // Periode magang
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('kelompok')->nullable(); // Kelompok
            $table->enum('status', ['aktif', 'selesai', 'drop'])->default('aktif');
            $table->timestamps();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

            Schema::create('pembimbing', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pembimbing');
            $table->string('kontak');
            $table->string('asal_sekolah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        // Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('pembimbing');
    }
};
