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
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->string('zoom_link')->nullable()->after('catatan');
            $table->dateTime('jadwal_presentasi')->nullable()->after('zoom_link');
        });

        // Update enum status
        DB::statement("ALTER TABLE pengajuans MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'dijadwalkan presentasi', 'revisi') DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        // Revert enum status
        DB::statement("ALTER TABLE pengajuans MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'ditolak', 'revisi') DEFAULT 'menunggu'");

        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn(['zoom_link', 'jadwal_presentasi']);
        });
    }
};
