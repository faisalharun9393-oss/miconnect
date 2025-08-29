<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_jabatan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_jabatan')->unique();
            $table->string('nama_jabatan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_jabatan');
    }
};
