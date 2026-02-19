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
        DB::table('settings')->insert([
            [
                'key' => 'ttd_1_label',
                'value' => 'Penandatangan A',
                'label' => 'Label Penandatangan 1',
                'description' => 'Label yang akan muncul di dropdown penandatangan pertama (misal: Kepala Sub Bagian TU)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'ttd_2_label',
                'value' => 'Penandatangan B',
                'label' => 'Label Penandatangan 2',
                'description' => 'Label yang akan muncul di dropdown penandatangan kedua (misal: Kepala Balai)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('settings')->whereIn('key', ['ttd_1_label', 'ttd_2_label'])->delete();
    }
};
