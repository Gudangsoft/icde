<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            // Make old required columns nullable (they may have existing data)
            $table->string('judul')->nullable()->change();
            $table->text('deskripsi')->nullable()->change();

            // New rich fields
            $table->string('nama_perusahaan')->nullable()->after('id');
            $table->string('tahun_berdiri')->nullable()->after('nama_perusahaan');
            $table->text('profil_singkat')->nullable()->after('tahun_berdiri');
            $table->text('alamat')->nullable()->after('misi');
            $table->string('telepon')->nullable()->after('alamat');
            $table->string('email')->nullable()->after('telepon');
            $table->string('fax')->nullable()->after('email');
            $table->string('website')->nullable()->after('fax');
            $table->string('logo')->nullable()->after('website');
        });
    }

    public function down(): void
    {
        Schema::table('tentang_kami', function (Blueprint $table) {
            $table->dropColumn([
                'nama_perusahaan', 'tahun_berdiri', 'profil_singkat',
                'alamat', 'telepon', 'email', 'fax', 'website', 'logo',
            ]);
            $table->string('judul')->nullable(false)->change();
            $table->text('deskripsi')->nullable(false)->change();
        });
    }
};
