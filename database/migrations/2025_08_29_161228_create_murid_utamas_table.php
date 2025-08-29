<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('murid_utamas', function (Blueprint $table) {
            $table->id();

            // Data Utama
            $table->string('nim')->unique();                   // Nomor Induk Murid
            $table->string('nama');                            // Nama Murid
            $table->enum('jk', ['L', 'P']);                    // Jenis Kelamin

            // Alamat
            $table->string('alamat');                          // Alamat Lengkap

            // Orang Tua / Wali
            $table->string('ayah')->nullable();                // Nama Ayah
            $table->string('ibu')->nullable();                 // Nama Ibu
            $table->foreignId('wali_id')                       // Relasi ke tabel wali
                  ->nullable()
                  ->constrained('wali_utamas')
                  ->nullOnDelete();

            // Pendidikan
            $table->string('angkatan');                        // Tahun Angkatan
            $table->date('mulai_aktif');                       // Tanggal Mulai Aktif
            $table->string('kelas_ammiyah')->nullable();       // Kelas Ammiyah
            $table->string('kelas_diniyah')->nullable();       // Kelas Diniyah

            // Status
            $table->enum('status', ['Aktif', 'Cuti', 'Nonaktif'])->default('Aktif');

            // Foto (opsional)
            $table->string('foto')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('murid_utamas');
    }
};
