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
        Schema::create('peserta_kecamatan', function (Blueprint $table) {
            // Foreign Key Constraints
            $table->foreignUuid('peserta_id')->references('id')->on('pesertas');
            $table->foreignUuid('kecamatan_id')->references('id')->on('kecamatans');
            // Setting The Primary Keys
            $table->primary(['peserta_id','kecamatan_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
