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
        Schema::create('peserta_tps', function (Blueprint $table) {
            // Foreign Key Constraints
            $table->foreignUuid('peserta_id')->references('id')->on('pesertas');
            $table->foreignUuid('tps_id')->references('id')->on('tps');

            // Setting The Primary Keys
            $table->primary(['peserta_id','tps_id']);
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
