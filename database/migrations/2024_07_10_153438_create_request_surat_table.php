<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestSuratTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request_surat', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('nim');
            $table->string('nama');
            $table->integer('angkatan');
            $table->unsignedBigInteger('prodi_id');
            $table->unsignedBigInteger('keperluan_id');
            $table->string('judul_skripsi')->nullable();
            $table->string('data_yang_dibutuhkan')->nullable();
            $table->integer('jumlah_data')->nullable();
            $table->string('cara_pengambilan_data')->nullable();
            $table->string('waktu_penelitian')->nullable();
            $table->string('dosen_pembimbing')->nullable();
            $table->string('no_telp');
            $table->string('nama_instansi');
            $table->string('nama_pimpinan');
            $table->string('alamat_instansi');
            $table->timestamps();

            $table->foreign('prodi_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('keperluan_id')->references('id')->on('jenis_surat_mahasiswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_surat', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
            $table->dropForeign(['keperluan_id']);
        });
        Schema::dropIfExists('request_surat');
    }
}
