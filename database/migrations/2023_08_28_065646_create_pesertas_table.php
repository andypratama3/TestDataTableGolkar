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
        Schema::create('pesertas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('nik')->max(16);
            $table->integer('hp');
            $table->date('tgl_lahir');
            $table->longText('alamat');
            $table->string('warna');
            $table->string('perekrut')->nullable();
            $table->string('status');
            // $table->string('latitude');
            // $table->string('longitude');
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
