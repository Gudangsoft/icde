<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->string('album')->nullable()->after('kategori');
            $table->unsignedBigInteger('pengalaman_id')->nullable()->after('album');

            $table->foreign('pengalaman_id')->references('id')->on('pengalaman')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropForeign(['pengalaman_id']);
            $table->dropColumn(['album', 'pengalaman_id']);
        });
    }
};
