<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuratDikirimToRequestSuratTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('request_surat', function (Blueprint $table) {
            $table->string('surat_dikirim')->nullable()->after('alamat_instansi'); // Adjust the 'after' parameter based on your table structure
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('request_surat', function (Blueprint $table) {
            $table->dropColumn('surat_dikirim');
        });
    }
}
