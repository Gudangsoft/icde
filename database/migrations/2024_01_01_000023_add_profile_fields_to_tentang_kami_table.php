<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            // Identitas Formal
            $table->string('nama_lengkap')->nullable()->after('nama_perusahaan');
            $table->string('bentuk_perusahaan')->nullable()->after('nama_lengkap');
            $table->string('status_kantor')->nullable()->after('bentuk_perusahaan');
            $table->string('pengesahan_badan_hukum')->nullable()->after('status_kantor');
            $table->string('direktur_utama')->nullable()->after('pengesahan_badan_hukum');

            // Akta Pendirian
            $table->string('akta_notaris')->nullable();
            $table->string('akta_nomor')->nullable();
            $table->string('akta_tanggal')->nullable();

            // Legalitas Usaha
            $table->string('npwp')->nullable();
            $table->string('nib')->nullable();
            $table->string('kbli')->nullable();
            $table->string('siup_tanggal')->nullable();

            // Keanggotaan
            $table->string('kadin_nomor')->nullable();
            $table->string('kadin_berlaku')->nullable();
            $table->string('inkindo_nomor')->nullable();
            $table->string('inkindo_berlaku')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            $table->dropColumn([
                'nama_lengkap', 'bentuk_perusahaan', 'status_kantor',
                'pengesahan_badan_hukum', 'direktur_utama',
                'akta_notaris', 'akta_nomor', 'akta_tanggal',
                'npwp', 'nib', 'kbli', 'siup_tanggal',
                'kadin_nomor', 'kadin_berlaku', 'inkindo_nomor', 'inkindo_berlaku',
            ]);
        });
    }
};
