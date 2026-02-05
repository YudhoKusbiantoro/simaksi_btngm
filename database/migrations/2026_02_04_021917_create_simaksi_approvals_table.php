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
        Schema::create('simaksi_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained('pengajuans')->onDelete('cascade');
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_terbit');
            $table->text('keterangan_surat_pengantar');
            $table->decimal('tarif_pnbp', 15, 2);
            $table->text('catatan_admin')->nullable();
            $table->text('tembusan')->nullable();
            $table->string('file_pdf')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simaksi_approvals');
    }
};
