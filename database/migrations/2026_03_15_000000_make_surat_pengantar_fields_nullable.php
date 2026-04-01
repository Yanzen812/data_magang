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
        Schema::table('surat_pengantar', function (Blueprint $table) {
            $table->string('kelompok')->nullable()->change();
            $table->unsignedBigInteger('id_pembimbing')->nullable()->change();
            $table->string('file')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_pengantar', function (Blueprint $table) {
            $table->string('kelompok')->nullable(false)->change();
            $table->unsignedBigInteger('id_pembimbing')->nullable(false)->change();
            $table->string('file')->nullable(false)->change();
        });
    }
};
