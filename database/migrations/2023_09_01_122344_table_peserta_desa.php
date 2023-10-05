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
        Schema::create('peserta_desa', function (Blueprint $table) {
            // Foreign Key Constraints
            $table->foreignUuid('peserta_id')->references('id')->on('pesertas');
            $table->foreignUuid('desa_id')->references('id')->on('desas');


            // Setting The Primary Keys
            $table->primary(['peserta_id','desa_id']);
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
