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
        Schema::create('prodi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prodi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ensure that foreign keys referencing this table are dropped
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
        });

        Schema::table('request_surat', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
        });

        Schema::dropIfExists('prodi');
    }
};

