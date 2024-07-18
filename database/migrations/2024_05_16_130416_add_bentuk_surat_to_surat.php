<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('surat', function (Blueprint $table) {
            // Check if the bentuk_surat column exists before trying to drop it
            if (Schema::hasColumn('surat', 'bentuk_surat')) {
                $table->dropColumn('bentuk_surat');
            }
            // Add the nomor_surat column with a unique constraint
            $table->string('nomor_surat')->unique()->after('jenis_surat_id');
        });
    }

    public function down()
    {
        Schema::table('surat', function (Blueprint $table) {
            // Drop the nomor_surat column if it exists
            if (Schema::hasColumn('surat', 'nomor_surat')) {
                $table->dropColumn('nomor_surat');
            }
            // Add the bentuk_surat column back if it was previously dropped
            $table->enum('bentuk_surat', ['hard_copy', 'soft_copy'])->default('hard_copy')->after('jenis_surat_id');
        });
    }
};
