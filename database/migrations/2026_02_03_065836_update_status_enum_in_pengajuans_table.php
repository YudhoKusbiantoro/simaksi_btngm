<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            // Using raw SQL to update enum if needed, or just change() if supported.
            // For Laravel 10+ change() is more robust.
            $table->string('status')->default('menunggu')->change(); // Temporary change to string to allow any value, or just add enum
        });

        // Better way for MySQL to update Enum
        DB::statement("ALTER TABLE pengajuans MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'ditolak', 'revisi') DEFAULT 'menunggu'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pengajuans MODIFY COLUMN status ENUM('menunggu', 'disetujui', 'ditolak') DEFAULT 'menunggu'");
    }
};
