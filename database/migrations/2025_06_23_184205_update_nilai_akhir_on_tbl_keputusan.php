<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tbl_keputusan', function (Blueprint $table) {
            $table->decimal('nilai_akhir', 8, 4)->change();
        });
    }

    public function down(): void
    {
        Schema::table('tbl_keputusan', function (Blueprint $table) {
            $table->string('nilai_akhir', 5)->change(); // jika ingin rollback
        });
    }
};
