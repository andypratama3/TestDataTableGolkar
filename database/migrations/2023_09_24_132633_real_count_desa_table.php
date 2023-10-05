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
        Schema::create('real_count_desa', function (Blueprint $table) {
            // Foreign Key Constraints
            $table->foreignUuid('realcount_id')->references('id')->on('realcounts')->onDelete('cascade');
            $table->foreignUuid('desa_id')->references('id')->on('desas');
            // Setting The Primary Keys
            $table->primary(['realcount_id','desa_id']);
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
