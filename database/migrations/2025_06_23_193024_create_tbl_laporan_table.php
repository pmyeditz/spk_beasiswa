<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_laporan', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nama_siswa');
            $table->decimal('nilai_akhir', 8, 4);
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_laporan');
    }
};
