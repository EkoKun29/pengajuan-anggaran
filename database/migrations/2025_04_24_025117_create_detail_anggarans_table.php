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
        Schema::create('detail_anggarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_anggaran');
            $table->string('barang_yang_diajukan')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('harga')->nullable();
            $table->string('kode_pajak')->nullable();
            $table->boolean('status_pengajuan')->default(0);
            $table->timestamps();

            //Relasi ID anggaran
            $table->foreign('id_anggaran')
                  ->references('id')
                  ->on('anggarans')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_anggarans');
    }
};
