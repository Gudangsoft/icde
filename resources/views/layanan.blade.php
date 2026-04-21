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

@php
    // Mapper for SVG Inner Content (Bootstrap Icons) - Ensuring multi-path support
    $iconSvgs = [
        'bi-diagram-3-fill' => '<path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1.5h1h3.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1a1.5 1.5 0 0 1 1.5-1.5h-1.5V7.5h-3.5h-1V6A1.5 1.5 0 0 1 10 4.5v-1zM8.5 4.5V3.5h-1v1h1zM11 9.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4.5 10a1.5 1.5 0 0 1-1.5-1.5v-1A1.5 1.5 0 0 1 4.5 6h1A1.5 1.5 0 0 1 7 7.5v1A1.5 1.5 0 0 1 5.5 10h-1zM4 8.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1zM9 13.5a1.5 1.5 0 0 1-1.5-1.5v-1A1.5 1.5 0 0 1 9 9.5h1A1.5 1.5 0 0 1 11.5 11v1A1.5 1.5 0 0 1 10 13.5H9zm.5-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>',
        'bi-clipboard2-check-fill' => '<path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/> <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>',
        'bi-bank2' => '<path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h15a.5.5 0 0 0 .277-.916l-7.5-5zM12.354 5 8 2.097 3.646 5h8.708zM5 14.5a.5.5 0 0 1 .5.5v.474a.5.5 0 0 1-1 0V15a.5.5 0 0 1 .5-.5zM8 14.5a.5.5 0 0 1 .5.5v.474a.5.5 0 0 1-1 0V15a.5.5 0 0 1 .5-.5zM11 14.5a.5.5 0 0 1 .5.5v.474a.5.5 0 0 1-1 0V15a.5.5 0 0 1 .5-.5zM2 14h12v.5a.5.5 0 0 1-1 0V14H3v.5a.5.5 0 0 1-1 0V14zM1 15h14v.5a.5.5 0 0 1-1 0H2a.5.5 0 0 1-1 0V15zM2 6h1.25L3 14H2V6zm11 0h1v8h-1l-.25-8zM9.5 6h.75l.25 8h-1.25l.25-8zM5.75 6h.75l.25 8h-1.25l.25-8z"/>',
        'bi-layers-half' => '<path d="M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.812 8l2.924-1.559a.5.5 0 0 0 0-.882l-7.5-4zM8 9.433 1.562 6 8 2.567 14.438 6 8 9.433z"/>',
        'bi-search' => '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>',
        'bi-people-fill' => '<path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>',
        'bi-clipboard-data' => '<path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 1 1 2 0v3a1 1 0 1 1-2 0V9z"/> <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/> <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3z"/>',
        
        // Database mappings (Fixing circles in screenshot)
        'bi-cloud-download-fill' => '<path fill-rule="evenodd" d="M6 3.5A1.5 1.5 0 0 1 7.5 2h1A1.5 1.5 0 0 1 10 3.5v1A1.5 1.5 0 0 1 8.5 6v1.5h1h3.5a1.5 1.5 0 0 1 1.5 1.5v1a1.5 1.5 0 0 1-1.5 1.5h-1a1.5 1.5 0 0 1-1.5-1.5v-1a1.5 1.5 0 0 1 1.5-1.5h-1.5V7.5h-3.5h-1V6A1.5 1.5 0 0 1 10 4.5v-1zM8.5 4.5V3.5h-1v1h1zM11 9.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4.5 10a1.5 1.5 0 0 1-1.5-1.5v-1A1.5 1.5 0 0 1 4.5 6h1A1.5 1.5 0 0 1 7 7.5v1A1.5 1.5 0 0 1 5.5 10h-1zM4 8.5a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1zM9 13.5a1.5 1.5 0 0 1-1.5-1.5v-1A1.5 1.5 0 0 1 9 9.5h1A1.5 1.5 0 0 1 11.5 11v1A1.5 1.5 0 0 1 10 13.5H9zm.5-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1z"/>', // Redirected to Planning
        'bi-journal-bookmark-fill' => '<path d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/> <path d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>', // Redirected to Evaluation
        'bi-graph-up-arrow' => '<path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.707l-5.364 5.364a.5.5 0 0 1-.708 0L5.293 7.929l-3.647 3.646a.5.5 0 1 1-.708-.708l4-4a.5.5 0 0 1 .708 0L8.293 9.071l4.646-4.647H10.5a.5.5 0 0 1-.5-.5Z"/>',
        'bi-file-earmark-gear-fill' => '<path d="M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.812 8l2.924-1.559a.5.5 0 0 0 0-.882l-7.5-4zM8 9.433 1.562 6 8 2.567 14.438 6 8 9.433z"/>', // Redirected to Sectoral
        'bi-search-heart-fill' => '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>', // Redirected to Search

        // Common fallbacks
        'bi-box-seam' => '<path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.722V6.838L1 4.24v7.922l6.5 2.6zM2.847 3.5l2.454.982L8 5.438l2.699-1.08L13.153 3.5 8 1.439 2.847 3.5z"/>',
    ];

    $fallbackIcon = '<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>'; // Circle as last resort
@endphp

<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">Lingkup Layanan</h2>
        </div>
        @if($layanan->isEmpty())
        <div class="row g-4">
            @foreach([
                ['ikon' => 'bi-diagram-3-fill', 'judul' => 'Perencanaan Pembangunan', 'deskripsi' => 'Layanan konsultansi dalam penyusunan dokumen perencanaan pembangunan daerah secara sistematis, terarah, dan berbasis analisis kondisi, potensi, serta isu strategis. Cakupan dokumen meliputi RPJPD, RPJMD, RKPD, dan Renstra Perangkat Daerah.'],
                ['ikon' => 'bi-clipboard2-check-fill', 'judul' => 'Evaluasi Pembangunan', 'deskripsi' => 'Layanan evaluasi untuk menilai capaian kinerja program dan kegiatan pembangunan, guna mengukur efektivitas, efisiensi, dan dampaknya. Hasil evaluasi disajikan dalam bentuk rekomendasi perbaikan kebijakan maupun program, termasuk laporan RPJMD, Evaluasi RKPD, LKjIP, LPPD, dan LKPJ.'],
                ['ikon' => 'bi-bank2', 'judul' => 'Analisis Pengelolaan Keuangan dan Aset Daerah', 'deskripsi' => 'Layanan konsultansi untuk perencanaan, pengelolaan, dan evaluasi keuangan daerah secara berkelanjutan dengan prinsip akuntabel, transparan, dan sesuai regulasi. Keluaran meliputi KUA-PPAS, kajian kapasitas fiskal, analisis APBD, efektivitas belanja daerah, serta strategi optimalisasi pemanfaatan aset.'],
                ['ikon' => 'bi-layers-half', 'judul' => 'Perencanaan Sektoral', 'deskripsi' => 'Layanan penyusunan rencana pembangunan pada sektor tertentu dengan mempertimbangkan kebutuhan, potensi, dan arah kebijakan daerah maupun nasional. Produk layanan meliputi Rencana Induk Pengembangan Sektor, Masterplan Sektoral, dan Rencana Aksi Sektoral.'],
                ['ikon' => 'bi-search', 'judul' => 'Penelitian dan Pengkajian', 'deskripsi' => 'Layanan konsultansi berupa pelaksanaan penelitian, studi, dan kajian untuk menghasilkan rekomendasi kebijakan berbasis data dan analisis ilmiah. Cakupan kajian meliputi kajian sektoral, kajian lintas isu, serta naskah akademik yang dilengkapi policy brief.'],
                ['ikon' => 'bi-people-fill', 'judul' => 'Peningkatan Kapasitas SDM Aparatur', 'deskripsi' => 'Layanan peningkatan kapasitas SDM aparatur pemerintah melalui pelatihan profesional, pendampingan, dan pengembangan kompetensi individu maupun organisasi. Program dirancang untuk memperkuat kinerja birokrasi serta mendukung tata kelola pemerintahan yang efektif (good governance).'],
            ] as $idx => $def)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 24px; background: linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark)); color: white; transition: all 0.4s ease; overflow: hidden; position: relative;">
                    <!-- Decor -->
                    <i class="bi {{ $def['ikon'] }} position-absolute" style="font-size: 8rem; opacity: 0.04; bottom: -20px; right: -10px; transform: rotate(-15deg);"></i>
                    <div class="p-4 p-md-5 d-flex flex-column h-100 position-relative z-1">
                        <div class="d-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--icde-gold), var(--icde-gold-light)); border-radius: 20px; box-shadow: 0 8px 25px rgba(132, 204, 22, 0.35); transform: rotate(-3deg);">
                             <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 16 16" fill="var(--icde-navy-dark)" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                                {!! $iconSvgs[$def['ikon']] ?? $fallbackIcon !!}
                             </svg>
                        </div>
                        <h5 class="fw-bold mb-3" style="font-size:1.35rem; letter-spacing: 0.5px;">{{ $def['judul'] }}</h5>
                        <div class="flex-grow-1" style="font-size: 0.98rem; line-height: 1.8; color: rgba(255,255,255,0.95); text-align: justify; font-weight: 500;">
                            {{ $def['deskripsi'] }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            @foreach($layanan as $item)
            @php
                $currentIcon = $item->ikon ?? 'bi-clipboard-data';
                if(!str_contains($currentIcon, 'bi-')) $currentIcon = 'bi-'.$currentIcon;
            @endphp
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="card border-0 shadow-lg h-100" style="border-radius: 24px; background: linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark)); color: white; transition: all 0.4s ease; overflow: hidden; position: relative;">
                    <!-- Decor -->
                    <i class="bi {{ $currentIcon }} position-absolute" style="font-size: 8rem; opacity: 0.04; bottom: -20px; right: -10px; transform: rotate(-15deg);"></i>
                    <div class="p-4 p-md-5 d-flex flex-column h-100 position-relative z-1">
                        <div class="d-flex align-items-center justify-content-center mb-4" style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--icde-gold), var(--icde-gold-light)); border-radius: 20px; box-shadow: 0 8px 25px rgba(132, 204, 22, 0.35); transform: rotate(-3deg);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 16 16" fill="var(--icde-navy-dark)" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                                {!! $iconSvgs[$currentIcon] ?? $fallbackIcon !!}
                            </svg>
                        </div>
                        <h5 class="fw-bold mb-3" style="font-size:1.35rem; letter-spacing: 0.5px;">{{ $item->judul }}</h5>
                        <div class="flex-grow-1" style="font-size: 0.98rem; line-height: 1.8; color: rgba(255,255,255,0.95); text-align: justify; font-weight: 500;">
                            {!! $item->deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>


@endsection
