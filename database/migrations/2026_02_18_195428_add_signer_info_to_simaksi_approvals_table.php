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
            $table->string('penandatangan_nama')->nullable()->after('tembusan');
            $table->string('penandatangan_nip')->nullable()->after('penandatangan_nama');
            $table->string('penandatangan_jabatan')->nullable()->after('penandatangan_nip');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simaksi_approvals', function (Blueprint $table) {
            $table->dropColumn(['penandatangan_nama', 'penandatangan_nip', 'penandatangan_jabatan']);
        });
    }
};
