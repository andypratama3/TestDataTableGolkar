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
        Schema::create('tps_desa', function (Blueprint $table) {
            // Foreign Key Constraints
            $table->foreignUuid('tps_id')->references('id')->on('tps');
            $table->foreignUuid('desa_id')->references('id')->on('desas');

            // Setting The Primary Keys
            $table->primary(['tps_id', 'desa_id']);
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
