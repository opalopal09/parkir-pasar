<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('kendaraans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tarif')->nullable();
            $table->unsignedBigInteger('id_area')->nullable();
            $table->dateTime('waktu_keluar')->nullable();
            $table->decimal('total_biaya', 15, 2)->nullable();
            $table->enum('status', ['masuk', 'keluar'])->default('masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kendaraans', function (Blueprint $table) {
            $table->dropColumn(['id_tarif', 'id_area', 'waktu_keluar', 'total_biaya', 'status']);
        });
    }
};
