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
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengirim_id')->constrained('users');
            $table->foreignId('penerima_id')->constrained('users');
            $table->date('tanggal');
            $table->string('nama');
            $table->string('perihal');
            $table->string('nama_surat');
            $table->unsignedBigInteger('jenis_surat_id');
            $table->string('filesurat');
            $table->string('status');
            $table->foreign('jenis_surat_id')->references('id')->on('jenis_surat');
            $table->string('tujuan')->nullable(); 
            $table->string('asal_surat')->nullable();
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat');
    }
};
