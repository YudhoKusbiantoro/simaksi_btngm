<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->string('nama_pemohon');       // Nama lengkap penanggung jawab
            $table->string('identitas')->nullable(); // NIM / KTP / NIK
            $table->string('jabatan');            // Peran: Koordinator, Ketua, dll
            $table->string('instansi');           // Asal: Universitas, Instansi, dll
        });
    }

    public function down()
    {
        Schema::table('pengajuans', function (Blueprint $table) {
            $table->dropColumn(['nama_pemohon', 'identitas', 'jabatan', 'instansi']);
        });
    }
};