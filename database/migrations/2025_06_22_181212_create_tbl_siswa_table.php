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
        Schema::create('tbl_siswa', function (Blueprint $table) {
            $table->string('nis')->primary();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin', 10);
            $table->decimal('nilai_rapor', 4, 2);
            $table->unsignedBigInteger('id_kelas');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('tbl_kelas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_siswa');
    }
};
