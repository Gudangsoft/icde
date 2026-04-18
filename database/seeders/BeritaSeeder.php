<?php

namespace Database\Seeders;

use App\Models\Berita;
use Illuminate\Database\Seeder;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'judul' => 'PT ICDE Raih Penghargaan Konsultan Terbaik 2026',
                'ringkasan' => 'PT Integrated Civil & Development Engineering berhasil meraih penghargaan sebagai konsultan teknik terbaik dalam ajang Indonesia Engineering Award 2026.',
                'konten' => "PT Integrated Civil & Development Engineering (ICDE) kembali mengukir prestasi gemilang dengan meraih penghargaan Konsultan Teknik Terbaik pada ajang Indonesia Engineering Award 2026 yang diselenggarakan di Jakarta Convention Center.\n\nPenghargaan ini diberikan atas dedikasi dan kontribusi luar biasa PT ICDE dalam berbagai proyek infrastruktur strategis nasional selama kurun waktu 2024-2026. Beberapa proyek unggulan yang menjadi penilaian meliputi perencanaan jalan tol, pengawasan pembangunan bendungan, serta studi kelayakan kawasan industri terpadu.\n\nDirektur Utama PT ICDE menyampaikan rasa syukur dan kebanggaan atas pencapaian ini. Beliau menegaskan bahwa penghargaan ini merupakan hasil kerja keras seluruh tim yang selalu mengedepankan kualitas, inovasi, dan integritas dalam setiap proyek yang ditangani.\n\nKe depan, PT ICDE berkomitmen untuk terus meningkatkan standar pelayanan dan mengadopsi teknologi terkini dalam bidang konsultansi teknik untuk mendukung pembangunan Indonesia yang berkelanjutan.",
                'kategori' => 'Perusahaan',
                'tanggal_publish' => '2026-04-10',
                'penulis' => 'Admin ICDE',
            ],
            [
                'judul' => 'Proyek Perencanaan Jalan Tol Semarang-Demak Resmi Dimulai',
                'ringkasan' => 'PT ICDE ditunjuk sebagai konsultan perencana utama untuk proyek pembangunan jalan tol Semarang-Demak sepanjang 27 km.',
                'konten' => "PT ICDE secara resmi ditunjuk sebagai konsultan perencana utama untuk proyek pembangunan Jalan Tol Semarang-Demak. Proyek strategis ini memiliki panjang total 27 kilometer dan diharapkan mampu mengurangi kemacetan di koridor utara Jawa Tengah.\n\nDalam proyek ini, PT ICDE bertanggung jawab atas penyusunan Detailed Engineering Design (DED), analisis dampak lingkungan, serta perencanaan sistem drainase dan struktur jalan. Tim ahli yang terdiri dari insinyur sipil, ahli geoteknik, dan spesialis lingkungan telah disiapkan untuk memastikan kualitas perencanaan sesuai standar internasional.\n\nProyek ini ditargetkan selesai dalam waktu 3 tahun dan akan menjadi salah satu infrastruktur penting dalam mendukung konektivitas kawasan industri di pesisir utara Jawa Tengah.\n\nKepala Proyek dari PT ICDE menyatakan optimisme bahwa dengan pengalaman dan sumber daya yang dimiliki, proyek ini akan berjalan sesuai jadwal dan anggaran yang telah ditetapkan.",
                'kategori' => 'Proyek',
                'tanggal_publish' => '2026-04-05',
                'penulis' => 'Tim Komunikasi',
            ],
            [
                'judul' => 'Workshop Teknologi BIM untuk Peningkatan Kompetensi SDM',
                'ringkasan' => 'PT ICDE menyelenggarakan workshop Building Information Modeling (BIM) selama 3 hari untuk meningkatkan kompetensi tim teknis.',
                'konten' => "Dalam upaya meningkatkan kapasitas sumber daya manusia, PT ICDE menyelenggarakan Workshop Building Information Modeling (BIM) selama tiga hari di kantor pusat Semarang. Workshop ini diikuti oleh 25 staf teknis dari berbagai divisi.\n\nMateri yang disampaikan meliputi pengenalan konsep BIM, penggunaan software Revit dan Civil 3D, serta implementasi BIM dalam proyek infrastruktur. Narasumber yang dihadirkan merupakan praktisi BIM bersertifikasi internasional dari Singapura.\n\nPenerapan teknologi BIM sangat penting dalam era digitalisasi konstruksi karena memungkinkan visualisasi 3D, deteksi konflik desain sejak dini, serta estimasi biaya yang lebih akurat. PT ICDE menargetkan seluruh proyek baru akan menggunakan pendekatan BIM mulai tahun 2027.\n\nKegiatan ini merupakan bagian dari program pengembangan SDM berkelanjutan yang rutin dilaksanakan setiap kuartal.",
                'kategori' => 'Kegiatan',
                'tanggal_publish' => '2026-03-28',
                'penulis' => 'HRD ICDE',
            ],
            [
                'judul' => 'Kerjasama Strategis PT ICDE dengan Universitas Diponegoro',
                'ringkasan' => 'PT ICDE menandatangani MoU dengan Fakultas Teknik UNDIP untuk penelitian dan pengembangan di bidang teknik sipil.',
                'konten' => "PT ICDE dan Fakultas Teknik Universitas Diponegoro (UNDIP) resmi menandatangani Nota Kesepahaman (MoU) untuk kerjasama di bidang penelitian, pengembangan teknologi, dan program magang mahasiswa.\n\nKerjasama ini mencakup beberapa bidang utama antara lain penelitian bersama mengenai material konstruksi ramah lingkungan, pengembangan metode analisis struktur berbasis AI, serta penyediaan tempat magang bagi mahasiswa teknik sipil UNDIP di proyek-proyek PT ICDE.\n\nRektor UNDIP menyambut baik kerjasama ini dan berharap dapat menghasilkan inovasi-inovasi baru yang bermanfaat bagi dunia konstruksi Indonesia. Sementara itu, Direktur PT ICDE menyampaikan bahwa kerjasama dengan perguruan tinggi merupakan investasi jangka panjang untuk kemajuan industri konsultansi teknik.\n\nMoU ini berlaku selama 5 tahun dan dapat diperpanjang sesuai kesepakatan kedua belah pihak.",
                'kategori' => 'Perusahaan',
                'tanggal_publish' => '2026-03-15',
                'penulis' => 'Admin ICDE',
            ],
            [
                'judul' => 'Studi Kelayakan Kawasan Industri Terpadu Kendal Selesai',
                'ringkasan' => 'Tim PT ICDE berhasil menyelesaikan studi kelayakan untuk pengembangan kawasan industri terpadu di Kabupaten Kendal, Jawa Tengah.',
                'konten' => "Tim konsultan PT ICDE telah berhasil menyelesaikan Studi Kelayakan (Feasibility Study) untuk pengembangan Kawasan Industri Terpadu di Kabupaten Kendal, Jawa Tengah. Studi ini mencakup analisis teknis, ekonomi, sosial, dan lingkungan.\n\nHasil studi menunjukkan bahwa kawasan seluas 500 hektar ini memiliki potensi besar untuk dikembangkan menjadi pusat industri manufaktur berbasis teknologi tinggi. Lokasi yang strategis dengan akses langsung ke pelabuhan dan bandara menjadi nilai tambah utama.\n\nDalam studi ini, PT ICDE juga merekomendasikan konsep kawasan industri hijau (green industrial estate) yang mengedepankan prinsip keberlanjutan, efisiensi energi, dan pengelolaan limbah terpadu.\n\nLaporan final telah diserahkan kepada Pemerintah Kabupaten Kendal dan akan menjadi acuan dalam penyusunan masterplan kawasan industri tersebut.",
                'kategori' => 'Proyek',
                'tanggal_publish' => '2026-03-01',
                'penulis' => 'Tim Komunikasi',
            ],
            [
                'judul' => 'PT ICDE Ikut Serta dalam Pameran Infrastruktur Indonesia 2026',
                'ringkasan' => 'PT ICDE berpartisipasi dalam pameran Indonesia Infrastructure Week 2026 di Jakarta, menampilkan portofolio proyek dan teknologi terbaru.',
                'konten' => "PT ICDE turut berpartisipasi dalam Indonesia Infrastructure Week (IIW) 2026 yang diselenggarakan di Jakarta International Expo pada tanggal 20-22 Februari 2026. Pameran ini diikuti oleh lebih dari 200 perusahaan dari sektor konstruksi dan infrastruktur.\n\nDi booth PT ICDE, pengunjung dapat melihat showcase portofolio proyek-proyek unggulan yang telah dikerjakan, termasuk demonstrasi teknologi BIM dan drone surveying yang digunakan dalam pekerjaan lapangan.\n\nSelama pameran berlangsung, tim PT ICDE berhasil menjalin kontak bisnis dengan beberapa perusahaan kontraktor besar dan instansi pemerintah. Beberapa peluang kerjasama potensial juga teridentifikasi untuk proyek-proyek di wilayah Indonesia Timur.\n\nPartisipasi dalam IIW 2026 ini menjadi ajang penting bagi PT ICDE untuk memperluas jaringan bisnis dan memperkenalkan kapabilitas perusahaan kepada pemangku kepentingan di industri infrastruktur.",
                'kategori' => 'Kegiatan',
                'tanggal_publish' => '2026-02-25',
                'penulis' => 'Admin ICDE',
            ],
        ];

        foreach ($articles as $a) {
            $a['slug'] = Berita::generateSlug($a['judul']);
            $a['aktif'] = true;
            Berita::create($a);
        }
    }
}
