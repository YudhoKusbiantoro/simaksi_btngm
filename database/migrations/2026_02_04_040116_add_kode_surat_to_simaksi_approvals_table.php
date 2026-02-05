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
        Schema::table('simaksi_approvals', function (Blueprint $table) {
            $table->string('kode_surat')->after('nomor_surat')->default('Lit.0.0');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simaksi_approvals', function (Blueprint $table) {
            $table->dropColumn('kode_surat');
        });
    }
};
