<?php

namespace Database\Seeders;

use App\Models\Sdm;
use Illuminate\Database\Seeder;

class SdmSeeder extends Seeder
{
    public function run(): void
    {
        Sdm::truncate();

        $data = [
            // ========== KOMISARIS ==========
            [
                'nama'       => 'Prof. Dr. Ir. H. Rachmat Witoelar, M.Sc',
                'jabatan'    => 'Komisaris',
                'deskripsi'  => 'Memiliki pengalaman lebih dari 30 tahun dalam bidang perencanaan pembangunan dan kebijakan publik. Pernah menjabat sebagai penasihat di berbagai kementerian dan lembaga pemerintah.',
                'keahlian'   => 'Kebijakan Publik, Perencanaan Pembangunan, Manajemen Strategis',
                'pendidikan' => 'S3 Perencanaan Wilayah - Universitas Indonesia',
                'foto'       => null,
                'urutan'     => 1,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Dr. Ir. Hj. Siti Nurbaya Bakar, M.Sc',
                'jabatan'    => 'Komisaris',
                'deskripsi'  => 'Berpengalaman dalam bidang lingkungan hidup dan tata kelola pemerintahan. Aktif dalam berbagai forum nasional dan internasional terkait pembangunan berkelanjutan.',
                'keahlian'   => 'Lingkungan Hidup, Tata Kelola Pemerintahan, Pembangunan Berkelanjutan',
                'pendidikan' => 'S3 Ilmu Lingkungan - Institut Pertanian Bogor',
                'foto'       => null,
                'urutan'     => 2,
                'aktif'      => true,
            ],

            // ========== DIREKSI ==========
            [
                'nama'       => 'Ir. H. Muhammad Arief Budiman, MT',
                'jabatan'    => 'Direksi',
                'deskripsi'  => 'Direktur Utama PT ICDE. Memimpin perusahaan sejak tahun 2010 dengan fokus pada pengembangan jasa konsultansi di bidang infrastruktur dan perencanaan wilayah.',
                'keahlian'   => 'Manajemen Proyek, Teknik Sipil, Perencanaan Infrastruktur',
                'pendidikan' => 'S2 Teknik Sipil - Institut Teknologi Bandung',
                'foto'       => null,
                'urutan'     => 3,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Dr. Hj. Ratna Dewi Paramita, SE, M.Si',
                'jabatan'    => 'Direksi',
                'deskripsi'  => 'Direktur Keuangan dan Administrasi. Bertanggung jawab atas pengelolaan keuangan, administrasi, dan sumber daya manusia perusahaan.',
                'keahlian'   => 'Manajemen Keuangan, Administrasi Bisnis, Akuntansi',
                'pendidikan' => 'S3 Manajemen - Universitas Gadjah Mada',
                'foto'       => null,
                'urutan'     => 4,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Ir. Bambang Suryanto, M.Eng',
                'jabatan'    => 'Direksi',
                'deskripsi'  => 'Direktur Teknik dan Operasional. Mengawasi pelaksanaan seluruh proyek konsultansi dan memastikan kualitas output sesuai standar.',
                'keahlian'   => 'Teknik Sipil, Manajemen Konstruksi, Quality Assurance',
                'pendidikan' => 'S2 Teknik Sipil - Universitas Diponegoro',
                'foto'       => null,
                'urutan'     => 5,
                'aktif'      => true,
            ],

            // ========== TENAGA AHLI ==========
            [
                'nama'       => 'DR. Budi Santoso, M.Si',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Perencanaan Wilayah dan Kota dengan pengalaman lebih dari 20 tahun dalam penyusunan RTRW, RDTR, dan dokumen perencanaan spasial lainnya.',
                'keahlian'   => 'Perencanaan Wilayah & Kota, Tata Ruang, GIS',
                'pendidikan' => 'S3 Perencanaan Wilayah - Universitas Diponegoro',
                'foto'       => null,
                'urutan'     => 6,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Ir. Siti Rahayu, MT',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Teknik Sipil & Infrastruktur dengan spesialisasi di bidang perencanaan jalan, jembatan, dan bangunan gedung.',
                'keahlian'   => 'Teknik Sipil, Infrastruktur, Perencanaan Jalan & Jembatan',
                'pendidikan' => 'S2 Teknik Sipil - ITS Surabaya',
                'foto'       => null,
                'urutan'     => 7,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Drs. Ahmad Fauzi, M.Ec',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Ekonomi Pembangunan yang berpengalaman dalam analisis ekonomi regional, studi kelayakan, dan evaluasi proyek pembangunan.',
                'keahlian'   => 'Ekonomi Pembangunan, Analisis Kelayakan, Ekonomi Regional',
                'pendidikan' => 'S2 Ilmu Ekonomi - UGM Yogyakarta',
                'foto'       => null,
                'urutan'     => 8,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Dr. Dewi Lestari, M.Si',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Sosiologi & Kemasyarakatan dengan fokus pada pemberdayaan masyarakat, kajian sosial, dan analisis dampak sosial.',
                'keahlian'   => 'Sosiologi, Pemberdayaan Masyarakat, Analisis Dampak Sosial',
                'pendidikan' => 'S3 Sosiologi - Universitas Indonesia',
                'foto'       => null,
                'urutan'     => 9,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Arif Nugroho, S.Si, M.GIS',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Pemetaan & Sistem Informasi Geografis dengan keahlian dalam pengolahan data spasial, remote sensing, dan analisis geospasial.',
                'keahlian'   => 'GIS, Remote Sensing, Pemetaan Digital, Analisis Geospasial',
                'pendidikan' => 'S2 Geographic Information System - UGM',
                'foto'       => null,
                'urutan'     => 10,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Dr. Rina Wulandari, M.Kes',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Kesehatan Masyarakat dengan spesialisasi dalam kajian kesehatan lingkungan, epidemiologi, dan perencanaan fasilitas kesehatan.',
                'keahlian'   => 'Kesehatan Masyarakat, Epidemiologi, Kesehatan Lingkungan',
                'pendidikan' => 'S3 Kesehatan Masyarakat - UNDIP Semarang',
                'foto'       => null,
                'urutan'     => 11,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Ir. Hendra Wijaya, M.Sc',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Lingkungan Hidup dengan keahlian dalam penyusunan AMDAL, UKL-UPL, dan kajian lingkungan strategis.',
                'keahlian'   => 'AMDAL, Kajian Lingkungan, Pengelolaan Lingkungan Hidup',
                'pendidikan' => 'S2 Ilmu Lingkungan - Universitas Indonesia',
                'foto'       => null,
                'urutan'     => 12,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Dr. Ir. Teguh Prasetyo, M.Eng',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Sumber Daya Air dengan pengalaman dalam perencanaan irigasi, pengendalian banjir, dan pengelolaan DAS.',
                'keahlian'   => 'Sumber Daya Air, Irigasi, Pengendalian Banjir, DAS',
                'pendidikan' => 'S3 Teknik Sipil (Sumber Daya Air) - ITB',
                'foto'       => null,
                'urutan'     => 13,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Dra. Yuni Astuti, M.Pd',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Pendidikan dan Pengembangan SDM dengan fokus pada pelatihan, capacity building, dan pengembangan kurikulum.',
                'keahlian'   => 'Pendidikan, Pengembangan SDM, Capacity Building',
                'pendidikan' => 'S2 Manajemen Pendidikan - Universitas Negeri Semarang',
                'foto'       => null,
                'urutan'     => 14,
                'aktif'      => true,
            ],
            [
                'nama'       => 'Ir. Dedi Kurniawan, MT, IPM',
                'jabatan'    => 'Tenaga Ahli',
                'deskripsi'  => 'Ahli Transportasi dan Manajemen Lalu Lintas dengan pengalaman dalam perencanaan transportasi perkotaan dan antar kota.',
                'keahlian'   => 'Transportasi, Manajemen Lalu Lintas, Perencanaan Transportasi',
                'pendidikan' => 'S2 Teknik Sipil (Transportasi) - ITS Surabaya',
                'foto'       => null,
                'urutan'     => 15,
                'aktif'      => true,
            ],
        ];

        foreach ($data as $item) {
            Sdm::create($item);
        }
    }
}
