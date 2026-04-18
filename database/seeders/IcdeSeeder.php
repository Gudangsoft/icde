<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IcdeSeeder extends Seeder
{
    public function run(): void
    {
        // Beranda
        DB::table('beranda')->insert([
            'judul'     => 'Konsultan Profesional Perencanaan & Evaluasi Pembangunan',
            'deskripsi' => 'PT. ICDE adalah konsultan profesional di bidang perencanaan, evaluasi pembangunan, penelitian dan kajian berbasis data, menghadirkan analisis tajam untuk menghasilkan kebijakan yang tepat, terukur, dan berdampak nyata.',
            'motto'     => '"Mitra Cerdas untuk Pembangunan Berkualitas dan Berkelanjutan"',
            'aktif'     => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tentang Kami
        DB::table('tentang_kami')->insert([
            'judul'     => 'PT ICDE Semarang',
            'deskripsi' => 'PT. ICDE (Integrated Consultants for Development and Evaluation) merupakan perusahaan konsultan yang bergerak di bidang perencanaan pembangunan, evaluasi program, penelitian kebijakan, dan kajian berbasis data. Berdiri sejak tahun 1999 dan berkantor pusat di Semarang, Jawa Tengah, PT ICDE telah membangun reputasi sebagai mitra terpercaya bagi pemerintah pusat, pemerintah daerah, BUMN, dan lembaga internasional.',
            'visi'      => 'Menjadi perusahaan konsultan terkemuka di Indonesia yang dipercaya dalam memberikan solusi perencanaan dan evaluasi pembangunan yang berkualitas, inovatif, dan berdampak nyata bagi masyarakat.',
            'misi'      => "1. Menyediakan layanan konsultansi perencanaan dan evaluasi pembangunan yang berkualitas dan dapat dipertanggungjawabkan.\n2. Mengembangkan SDM yang profesional, kompeten, dan berintegritas tinggi.\n3. Menerapkan metodologi penelitian dan kajian berbasis data yang ilmiah dan terstandar.\n4. Membangun kemitraan strategis dengan pemerintah, swasta, dan akademisi untuk pembangunan berkelanjutan.\n5. Berkontribusi aktif dalam peningkatan kualitas kebijakan pembangunan nasional dan daerah.",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Layanan ditangani oleh LayananSeeder
        // SDM
        $sdm = [
            ['nama' => 'DR. Budi Santoso, M.Si', 'jabatan' => 'Team Leader / Ahli Perencanaan', 'pendidikan' => 'S3 Perencanaan Wilayah - UNDIP', 'keahlian' => 'Perencanaan Pembangunan, Kebijakan Publik', 'urutan' => 1],
            ['nama' => 'Ir. Siti Rahayu, MT', 'jabatan' => 'Ahli Teknik Sipil & Infrastruktur', 'pendidikan' => 'S2 Teknik Sipil - ITS Surabaya', 'keahlian' => 'Infrastruktur, Studi Kelayakan Teknis', 'urutan' => 2],
            ['nama' => 'Drs. Ahmad Fauzi, M.Ec', 'jabatan' => 'Ahli Ekonomi Pembangunan', 'pendidikan' => 'S2 Ilmu Ekonomi - UGM Yogyakarta', 'keahlian' => 'Ekonomi Pembangunan, Analisis Biaya Manfaat', 'urutan' => 3],
            ['nama' => 'Dr. Dewi Lestari, M.Si', 'jabatan' => 'Ahli Sosiologi & Kemasyarakatan', 'pendidikan' => 'S3 Sosiologi - Universitas Indonesia', 'keahlian' => 'Kajian Sosial, Analisis Dampak Sosial', 'urutan' => 4],
            ['nama' => 'Arif Nugroho, S.Si, M.GIS', 'jabatan' => 'Ahli Pemetaan & GIS', 'pendidikan' => 'S2 Geographic Information System - UGM', 'keahlian' => 'GIS, Remote Sensing, Pemetaan Spasial', 'urutan' => 5],
            ['nama' => 'Dr. Rina Wulandari, M.Kes', 'jabatan' => 'Ahli Kesehatan Masyarakat', 'pendidikan' => 'S3 Kesehatan Masyarakat - UNDIP Semarang', 'keahlian' => 'Kesehatan Masyarakat, Evaluasi Program Kesehatan', 'urutan' => 6],
        ];
        foreach ($sdm as $s) {
            DB::table('sdm')->insert(array_merge($s, ['aktif' => true, 'created_at' => now(), 'updated_at' => now()]));
        }

        // Pengalaman
        $pengalaman = [
            ['nama_proyek' => 'Penyusunan RPJMD Kota Semarang 2025-2029', 'pemberi_kerja' => 'Bappeda Kota Semarang', 'lokasi' => 'Kota Semarang', 'tahun' => '2024', 'kategori' => 'Perencanaan'],
            ['nama_proyek' => 'Evaluasi Program Pengentasan Kemiskinan Jawa Tengah', 'pemberi_kerja' => 'Bappeda Provinsi Jawa Tengah', 'lokasi' => 'Jawa Tengah', 'tahun' => '2024', 'kategori' => 'Evaluasi'],
            ['nama_proyek' => 'Kajian Pengembangan Kawasan Industri Terpadu', 'pemberi_kerja' => 'Dinas Perindustrian Kab. Demak', 'lokasi' => 'Kabupaten Demak', 'tahun' => '2023', 'kategori' => 'Kajian'],
            ['nama_proyek' => 'Studi Kelayakan Pembangunan Pasar Modern', 'pemberi_kerja' => 'Dinas Perdagangan Kota Magelang', 'lokasi' => 'Kota Magelang', 'tahun' => '2023', 'kategori' => 'Kelayakan'],
            ['nama_proyek' => 'Survei Kepuasan Masyarakat Pelayanan Publik', 'pemberi_kerja' => 'Ombudsman RI Perwakilan Jateng', 'lokasi' => 'Jawa Tengah', 'tahun' => '2023', 'kategori' => 'Survei'],
            ['nama_proyek' => 'Penyusunan Renstra Dinas Kesehatan 2022-2026', 'pemberi_kerja' => 'Dinas Kesehatan Kab. Kendal', 'lokasi' => 'Kabupaten Kendal', 'tahun' => '2022', 'kategori' => 'Perencanaan'],
            ['nama_proyek' => 'Kajian Dampak Sosial Ekonomi Proyek Infrastruktur', 'pemberi_kerja' => 'PT Wijaya Karya (Persero)', 'lokasi' => 'Jawa Tengah', 'tahun' => '2022', 'kategori' => 'Kajian'],
            ['nama_proyek' => 'Evaluasi Kinerja Pemerintah Daerah (EKPD)', 'pemberi_kerja' => 'Bappenas RI', 'lokasi' => 'Jawa Tengah & DIY', 'tahun' => '2022', 'kategori' => 'Evaluasi'],
            ['nama_proyek' => 'Kajian Pemanfaatan Dana Desa Tahun 2020', 'pemberi_kerja' => 'Kementerian Desa PDTT', 'lokasi' => 'Jawa Tengah', 'tahun' => '2021', 'kategori' => 'Kajian'],
            ['nama_proyek' => 'Pembuatan Peta Rencana Tata Ruang Wilayah', 'pemberi_kerja' => 'Bappeda Kab. Batang', 'lokasi' => 'Kabupaten Batang', 'tahun' => '2021', 'kategori' => 'Pemetaan'],
        ];
        foreach ($pengalaman as $idx => $p) {
            DB::table('pengalaman')->insert(array_merge($p, ['urutan' => $idx + 1, 'created_at' => now(), 'updated_at' => now()]));
        }

        // Klien
        $klien = [
            ['nama' => 'Bappenas RI', 'urutan' => 1],
            ['nama' => 'Kementerian Desa PDTT', 'urutan' => 2],
            ['nama' => 'Bappeda Prov. Jawa Tengah', 'urutan' => 3],
            ['nama' => 'Bappeda Kota Semarang', 'urutan' => 4],
            ['nama' => 'Ombudsman RI', 'urutan' => 5],
            ['nama' => 'PT Wijaya Karya', 'urutan' => 6],
            ['nama' => 'Bank Jateng', 'urutan' => 7],
            ['nama' => 'UNDP Indonesia', 'urutan' => 8],
        ];
        foreach ($klien as $k) {
            DB::table('klien')->insert(array_merge($k, ['aktif' => true, 'created_at' => now(), 'updated_at' => now()]));
        }

        // Testimoni
        $testimoni = [
            ['nama' => 'DR. Heru Santoso, M.Si', 'jabatan' => 'Kepala Bappeda', 'instansi' => 'Kota Semarang', 'bintang' => 5, 'isi' => 'PT ICDE telah membantu kami dalam menyusun RPJMD dengan sangat profesional. Metodologi yang digunakan komprehensif dan hasilnya memuaskan. Tim yang berpengalaman dan sangat responsif.'],
            ['nama' => 'Ir. Sari Dewi Pratiwi', 'jabatan' => 'Direktur Perencanaan', 'instansi' => 'Kementerian Desa PDTT', 'bintang' => 5, 'isi' => 'Kajian yang dihasilkan PT ICDE sangat berkualitas tinggi dan berbasis data akurat. Rekomendasi yang diberikan sangat actionable dan telah kami implementasikan dalam kebijakan.'],
            ['nama' => 'Drs. Ahmad Fauzan', 'jabatan' => 'Bupati', 'instansi' => 'Kabupaten Demak', 'bintang' => 5, 'isi' => 'Sangat puas dengan layanan PT ICDE dalam mendampingi penyusunan dokumen perencanaan daerah. Profesional, tepat waktu, dan hasilnya sesuai kebutuhan daerah kami.'],
        ];
        foreach ($testimoni as $t) {
            DB::table('testimoni')->insert(array_merge($t, ['aktif' => true, 'created_at' => now(), 'updated_at' => now()]));
        }
    }
}
