<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id('id_guru');
            $table->string('nama_guru', 30);
            $table->string('nip', 20)->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('no_hp', 12)->nullable();
            $table->string('username', 20)->unique();
            $table->string('email', 50)->unique();
            $table->enum('role', ['wali_kelas', 'kepala_sekolah']);
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
