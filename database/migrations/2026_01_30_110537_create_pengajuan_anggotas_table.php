<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengajuan_anggotas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_id')->constrained()->onDelete('cascade');
            $table->string('nama');
            $table->string('identitas')->nullable(); // NIM, KTP, dll
            $table->string('peran')->nullable();   // Anggota, Dosen, Koordinator, dll
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengajuan_anggotas');
    }
};