<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengalaman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_proyek');
            $table->string('pemberi_kerja');
            $table->string('lokasi')->nullable();
            $table->string('tahun');
            $table->text('deskripsi')->nullable();
            $table->string('kategori')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengalaman');
    }
};
