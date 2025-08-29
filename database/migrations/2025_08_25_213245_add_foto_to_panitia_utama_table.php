<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('panitia_utama', function (Blueprint $table) {
        if (!Schema::hasColumn('panitia_utama', 'foto')) {
            $table->string('foto')->nullable();
        }
    });
}

};
