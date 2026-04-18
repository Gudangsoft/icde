<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengalamanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengalaman')->truncate();

        $data = [
            // Perencanaan Pembangunan
            [
                'nama_proyek'   => 'Penyusunan Dokumen Teknokratis RPJPD Kota Surakarta Tahun 2025-2045',
                'pemberi_kerja' => 'Bappeda Kota Surakarta',
                'lokasi'        => 'Kota Surakarta',
                'tahun'         => '2025',
                'kategori'      => 'Perencanaan Pembangunan',
                'urutan'        => 1,
            ],
            [
                'nama_proyek'   => 'Penyusunan RPJPD Kabupaten Sragen 2025-2045',
                'pemberi_kerja' => 'Bappeda Kabupaten Sragen',
                'lokasi'        => 'Kabupaten Sragen',
                'tahun'         => '2025',
                'kategori'      => 'Perencanaan Pembangunan',
                'urutan'        => 2,
            ],
            [
                'nama_proyek'   => 'Penyusunan Rancangan Teknokratik RPJMD Kabupaten Sukoharjo Tahun 2025 – 2029',
                'pemberi_kerja' => 'Bappeda Kabupaten Sukoharjo',
                'lokasi'        => 'Kabupaten Sukoharjo',
                'tahun'         => '2025',
                'kategori'      => 'Perencanaan Pembangunan',
                'urutan'        => 3,
            ],

            // Evaluasi Pembangunan
            [
                'nama_proyek'   => 'Penyusunan Buku Profil Jawa Tengah Tahun 2025',
                'pemberi_kerja' => 'Bappeda Provinsi Jawa Tengah',
                'lokasi'        => 'Provinsi Jawa Tengah',
                'tahun'         => '2025',
                'kategori'      => 'Evaluasi Pembangunan',
                'urutan'        => 4,
            ],
            [
                'nama_proyek'   => 'Evaluasi Perencanaan Dinas Perindustrian Kota Semarang Tahun 2024',
                'pemberi_kerja' => 'Dinas Perindustrian Kota Semarang',
                'lokasi'        => 'Kota Semarang',
                'tahun'         => '2024',
                'kategori'      => 'Evaluasi Pembangunan',
                'urutan'        => 5,
            ],
            [
                'nama_proyek'   => 'Penyusunan Evaluasi Hasil RKPD Tahun 2024 Semester I dan II Kota Surakarta',
                'pemberi_kerja' => 'Bappeda Kota Surakarta',
                'lokasi'        => 'Kota Surakarta',
                'tahun'         => '2024',
                'kategori'      => 'Evaluasi Pembangunan',
                'urutan'        => 6,
            ],

            // Perencanaan Sektoral
            [
                'nama_proyek'   => 'Penyusunan Dokumen Rencana Aksi Daerah (RAD) Pengarusutamaan Gender (PUG) Tahun 2025 – 2029 Kota Semarang',
                'pemberi_kerja' => 'Bappeda Kota Semarang',
                'lokasi'        => 'Kota Semarang',
                'tahun'         => '2025',
                'kategori'      => 'Perencanaan Sektoral',
                'urutan'        => 7,
            ],
            [
                'nama_proyek'   => 'RAD Pangan Gizi Kota Surakarta Tahun 2024',
                'pemberi_kerja' => 'Dinas Ketahanan Pangan Kota Surakarta',
                'lokasi'        => 'Kota Surakarta',
                'tahun'         => '2024',
                'kategori'      => 'Perencanaan Sektoral',
                'urutan'        => 8,
            ],
            [
                'nama_proyek'   => 'Penyusunan RAD SDG\'s Kota Tegal Tahun 2024',
                'pemberi_kerja' => 'Bappeda Kota Tegal',
                'lokasi'        => 'Kota Tegal',
                'tahun'         => '2024',
                'kategori'      => 'Perencanaan Sektoral',
                'urutan'        => 9,
            ],

            // Penelitian dan Pengkajian
            [
                'nama_proyek'   => 'Analisis Dampak Investasi Infrastruktur Terhadap Pertumbuhan Ekonomi Kabupaten Cilacap Tahun 2025',
                'pemberi_kerja' => 'Bappeda Kabupaten Cilacap',
                'lokasi'        => 'Kabupaten Cilacap',
                'tahun'         => '2025',
                'kategori'      => 'Penelitian dan Pengkajian',
                'urutan'        => 10,
            ],
            [
                'nama_proyek'   => 'Feasibility Study Islamic Center Kabupaten Banjarnegara Tahun 2025',
                'pemberi_kerja' => 'Pemerintah Kabupaten Banjarnegara',
                'lokasi'        => 'Kabupaten Banjarnegara',
                'tahun'         => '2025',
                'kategori'      => 'Penelitian dan Pengkajian',
                'urutan'        => 11,
            ],
            [
                'nama_proyek'   => 'Naskah Akademik LP2B Kota Tegal 2025',
                'pemberi_kerja' => 'Bappeda Kota Tegal',
                'lokasi'        => 'Kota Tegal',
                'tahun'         => '2025',
                'kategori'      => 'Penelitian dan Pengkajian',
                'urutan'        => 12,
            ],

            // Analisis Pengelolaan Keuangan dan Aset Daerah
            [
                'nama_proyek'   => 'Penyusunan Dokumen KUA PPAS Tahun 2024 Kabupaten Klaten',
                'pemberi_kerja' => 'Bappeda Kabupaten Klaten',
                'lokasi'        => 'Kabupaten Klaten',
                'tahun'         => '2024',
                'kategori'      => 'Analisis Pengelolaan Keuangan dan Aset Daerah',
                'urutan'        => 13,
            ],
            [
                'nama_proyek'   => 'Penyusunan Perubahan KUA dan Perubahan PPAS Kabupaten Klaten Tahun 2025',
                'pemberi_kerja' => 'Bappeda Kabupaten Klaten',
                'lokasi'        => 'Kabupaten Klaten',
                'tahun'         => '2025',
                'kategori'      => 'Analisis Pengelolaan Keuangan dan Aset Daerah',
                'urutan'        => 14,
            ],

            // Peningkatan Kapasitas SDM Aparatur
            [
                'nama_proyek'   => 'Pelatihan Perencanaan Pembangunan Daerah Kabupaten Grobogan Tahun 2025',
                'pemberi_kerja' => 'BKPSDMD Kabupaten Grobogan',
                'lokasi'        => 'Kabupaten Grobogan',
                'tahun'         => '2025',
                'kategori'      => 'Peningkatan Kapasitas SDM Aparatur',
                'urutan'        => 15,
            ],
            [
                'nama_proyek'   => 'Pelatihan Manajemen Risiko Perangkat Daerah Kota Semarang Tahun 2025',
                'pemberi_kerja' => 'BKPSDMD Kota Semarang',
                'lokasi'        => 'Kota Semarang',
                'tahun'         => '2025',
                'kategori'      => 'Peningkatan Kapasitas SDM Aparatur',
                'urutan'        => 16,
            ],
        ];

        foreach ($data as $item) {
            DB::table('pengalaman')->insert(array_merge($item, [
                'deskripsi'  => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
