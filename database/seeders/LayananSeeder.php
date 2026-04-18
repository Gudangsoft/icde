<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('layanan')->truncate();

        $layanan = [
            [
                'judul'   => 'Perencanaan Pembangunan',
                'deskripsi' => 'Layanan konsultansi dalam penyusunan dokumen perencanaan pembangunan daerah atau organisasi secara sistematis dan terarah berdasarkan analisis kondisi, potensi, dan permasalahan pembangunan. Hasil layanan berupa dokumen perencanaan seperti RPJPD, RPJMD, RKPD dan Renstra Perangkat Daerah.',
                'ikon'    => 'bi-cloud-download-fill',
                'urutan'  => 1,
            ],
            [
                'judul'   => 'Evaluasi Pembangunan',
                'deskripsi' => 'Layanan konsultansi untuk menilai capaian kinerja program dan kegiatan pembangunan guna mengetahui tingkat efektivitas, efisiensi, serta dampaknya, sekaligus memberikan rekomendasi perbaikan kebijakan atau program. Hasil layanan berupa Laporan Evaluasi RPJMD, Evaluasi RKPD, LKjIP, LPPD, dan LKPJ.',
                'ikon'    => 'bi-journal-bookmark-fill',
                'urutan'  => 2,
            ],
            [
                'judul'   => 'Analisis Pengelolaan Keuangan dan Aset Daerah',
                'deskripsi' => 'Layanan konsultansi yang mendukung perencanaan, pengelolaan, dan evaluasi keuangan daerah guna meningkatkan kualitas tata kelola fiskal yang transparan, akuntabel, dan sesuai regulasi. Hasil layanan berupa KUA PPAS, Kajian Kapasitas Fiskal Daerah, Analisis APBD, Kajian Efektivitas Belanja Daerah, Strategi Peningkatan PAD, dan optimalisasi pemanfaatan aset.',
                'ikon'    => 'bi-graph-up-arrow',
                'urutan'  => 3,
            ],
            [
                'judul'   => 'Perencanaan Sektoral',
                'deskripsi' => 'Layanan konsultansi dalam penyusunan rencana pembangunan pada sektor tertentu dengan mempertimbangkan kebutuhan, potensi, dan arah kebijakan pembangunan daerah maupun nasional. Hasil layanan berupa Rencana Induk Pengembangan Sektor, Masterplan Sektoral, dan Rencana Aksi Sektoral.',
                'ikon'    => 'bi-file-earmark-gear-fill',
                'urutan'  => 4,
            ],
            [
                'judul'   => 'Penelitian dan Pengkajian',
                'deskripsi' => 'Layanan konsultansi berupa pelaksanaan penelitian, studi, atau kajian untuk menghasilkan rekomendasi kebijakan berbasis data dan analisis ilmiah. Hasil layanan kajian berupa buku kajian sektoral maupun multisektor, naskah akademik yang fokus pada isu-isu tertentu yang dilengkapi dengan Policy Brief.',
                'ikon'    => 'bi-search-heart-fill',
                'urutan'  => 5,
            ],
            [
                'judul'   => 'Peningkatan Kapasitas SDM Aparatur',
                'deskripsi' => 'Layanan jasa konsultansi untuk peningkatan kapasitas SDM aparatur pemerintahan merupakan serangkaian kegiatan profesional yang bertujuan untuk meningkatkan kompetensi individu dan organisasi aparatur, memperbaiki kinerja birokrasi, dan mendukung tata kelola pemerintahan yang efektif (good governance).',
                'ikon'    => 'bi-people-fill',
                'urutan'  => 6,
            ],
        ];

        foreach ($layanan as $item) {
            DB::table('layanan')->insert(array_merge($item, [
                'aktif'      => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
