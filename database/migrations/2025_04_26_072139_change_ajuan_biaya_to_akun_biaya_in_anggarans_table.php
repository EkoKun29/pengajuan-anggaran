<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('anggarans', function (Blueprint $table) {
            $table->string('akun_biaya')
                  ->after('plot_yang_dipakai') 
                  ->nullable(); 
        });

        Schema::table('anggarans', function (Blueprint $table) {
            $table->dropColumn('ajuan_biaya');
        });
    }

    public function down()
    {

        Schema::table('anggarans', function (Blueprint $table) {
            $table->integer('ajuan_biaya')->nullable();
            $table->dropColumn('akun_biaya');
        });
    }
};