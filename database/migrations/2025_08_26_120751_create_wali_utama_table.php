<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wali_utama', function (Blueprint $table) {
            $table->id();
            $table->string('niw')->unique();        // Nomor Induk Wali
            $table->string('nama');
            $table->enum('jk', ['L','P']);
            $table->string('ayah')->nullable();
            $table->string('ibu')->nullable();

            // alamat disimpan ringkas; form akan menyusun otomatis dari prov/kab/kec/desa + detail
            $table->text('alamat')->nullable();

            // disimpan sebagai teks: "Milad ke-80 / 2025"
            $table->string('mulai_aktif')->nullable();

            $table->string('no_wa')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wali_utama');
    }
};
