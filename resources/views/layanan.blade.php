@extends('layouts.app')

@section('title', 'Lingkup Layanan - PT ICDE')

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">{{ \App\Models\Setting::get('page_layanan_title', 'Lingkup Layanan') }}</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Lingkup Layanan</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">Layanan Unggulan Kami</h2>
        </div>
        @if($layanan->isEmpty())
        <div class="row g-4">
            @foreach([
                ['ikon' => 'bi-cloud-download-fill', 'judul' => 'Perencanaan Pembangunan', 'deskripsi' => 'Layanan konsultansi dalam penyusunan dokumen perencanaan pembangunan daerah secara sistematis, terarah, dan berbasis analisis kondisi, potensi, serta isu strategis. Cakupan dokumen meliputi RPJPD, RPJMD, RKPD, dan Renstra Perangkat Daerah.'],
                ['ikon' => 'bi-journal-bookmark-fill', 'judul' => 'Evaluasi Pembangunan', 'deskripsi' => 'Layanan evaluasi untuk menilai capaian kinerja program dan kegiatan pembangunan, guna mengukur efektivitas, efisiensi, dan dampaknya. Hasil evaluasi disajikan dalam bentuk rekomendasi perbaikan kebijakan maupun program, termasuk laporan RPJMD, Evaluasi RKPD, LKjIP, LPPD, dan LKPJ.'],
                ['ikon' => 'bi-graph-up-arrow', 'judul' => 'Analisis Pengelolaan Keuangan dan Aset Daerah', 'deskripsi' => 'Layanan konsultansi untuk perencanaan, pengelolaan, dan evaluasi keuangan daerah secara berkelanjutan dengan prinsip akuntabel, transparan, dan sesuai regulasi. Keluaran meliputi KUA-PPAS, kajian kapasitas fiskal, analisis APBD, efektivitas belanja daerah, serta strategi optimalisasi pemanfaatan aset.'],
                ['ikon' => 'bi-file-earmark-gear-fill', 'judul' => 'Perencanaan Sektoral', 'deskripsi' => 'Layanan penyusunan rencana pembangunan pada sektor tertentu dengan mempertimbangkan kebutuhan, potensi, dan arah kebijakan daerah maupun nasional. Produk layanan meliputi Rencana Induk Pengembangan Sektor, Masterplan Sektoral, dan Rencana Aksi Sektoral.'],
                ['ikon' => 'bi-search-heart-fill', 'judul' => 'Penelitian dan Pengkajian', 'deskripsi' => 'Layanan konsultansi berupa pelaksanaan penelitian, studi, dan kajian untuk menghasilkan rekomendasi kebijakan berbasis data dan analisis ilmiah. Cakupan kajian meliputi kajian sektoral, kajian lintas isu, serta naskah akademik yang dilengkapi policy brief.'],
                ['ikon' => 'bi-people-fill', 'judul' => 'Peningkatan Kapasitas SDM Aparatur', 'deskripsi' => 'Layanan peningkatan kapasitas SDM aparatur pemerintah melalui pelatihan profesional, pendampingan, dan pengembangan kompetensi individu maupun organisasi. Program dirancang untuk memperkuat kinerja birokrasi serta mendukung tata kelola pemerintahan yang efektif (good governance).'],
            ] as $idx => $def)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}">
                <div class="card-icde p-4 h-100">
                    <div class="icon-box icon-box-primary">
                        <i class="bi {{ $def['ikon'] }}"></i>
                    </div>
                    <h5 style="font-weight:800;font-size:1.15rem;color:var(--icde-navy-dark);margin-bottom:12px;">{{ $def['judul'] }}</h5>
                    <p style="font-size:1rem;color:#334155;line-height:1.8;font-weight:500;">{{ $def['deskripsi'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            @foreach($layanan as $item)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="card-icde p-4 h-100">
                    <div class="icon-box icon-box-primary">
                        <i class="bi {{ $item->ikon ?? 'bi-clipboard-data' }}"></i>
                    </div>
                    <h5 style="font-weight:800;font-size:1.15rem;color:var(--icde-navy-dark);margin-bottom:12px;">{{ $item->judul }}</h5>
                    <div style="font-size:1rem;color:#334155;line-height:1.8;font-weight:500;">{!! $item->deskripsi !!}</div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>


@endsection
