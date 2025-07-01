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
        Schema::create('tbl_penilaian', function (Blueprint $table) {
            $table->id('id_penilaian');
            $table->string('nis');
            $table->unsignedBigInteger('id_kriteria');
            $table->string('nilai', 30);
            $table->timestamps();
            $table->foreign('nis')->references('nis')->on('tbl_siswa')->onDelete('cascade');
            $table->foreign('id_kriteria')->references('id_kriteria')->on('tbl_kriteria')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_penilaian');
    }
};
