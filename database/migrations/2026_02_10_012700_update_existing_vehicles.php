<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Update existing vehicles to have proper exit data for testing
        DB::table('kendaraans')->update([
            'waktu_keluar' => now(),
            'total_biaya' => 5000,
            'id_area' => 1,
            'id_tarif' => 1
        ]);
    }

    public function down()
    {
        //
    }
};
