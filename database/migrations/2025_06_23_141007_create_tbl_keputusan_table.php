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
        Schema::create('tbl_keputusan', function (Blueprint $table) {
            $table->id();
            $table->string('nis');
            $table->string('nilai_akhir', 5);
            $table->enum('status', ['diproses', 'diterima', 'ditolak'])->default('diproses');
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('tbl_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_keputusan');
    }
};
