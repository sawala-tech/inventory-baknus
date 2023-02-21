<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SuratMasuk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SuratMasuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->string('judul_surat');
            $table->enum('kategori', ['permohonan', 'undangan','pemberitahuan','permintaan','tugas','rekomendasi','pengantar']);
            $table->date('tanggal_masuk');
            $table->string('asal_surat');
            $table->string('keterangan');
            $table->string('file_surat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SuratMasuk');
    }
}
