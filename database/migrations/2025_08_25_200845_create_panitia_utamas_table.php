<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('panitia_utama', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nama', 150);
            $table->enum('jk', ['L', 'P']);
            $table->text('alamat');
            $table->foreignId('jabatan_id')->constrained('master_jabatan')->onDelete('cascade');
            $table->integer('angkatan');
            $table->integer('mulai_aktif');
            $table->date('tgl_masuk')->nullable();
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->string('no_telp', 20)->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        Schema::create('panitia_jabatan_histori', function (Blueprint $table) {
            $table->id();
            $table->foreignId('panitia_id')->constrained('panitia_utama')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained('master_jabatan')->onDelete('cascade');
            $table->integer('angkatan');
            $table->integer('tahun');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('panitia_jabatan_histori');
        Schema::dropIfExists('panitia_utama');
    }
};
