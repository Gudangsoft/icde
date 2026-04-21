@extends('layouts.app')

@section('title', 'Testimoni - PT ICDE')

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">{{ \App\Models\Setting::get('page_testimoni_title', 'Testimoni') }}</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Testimoni</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">Apa Kata Klien Kami</h2>
        </div>

        <style>
            .testimoni-card {
                background: linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark));
                color: white;
                border-radius: 24px;
                padding: 35px;
                box-shadow: 0 8px 32px rgba(6, 49, 30, 0.15);
                transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
                border: none;
                position: relative;
                overflow: hidden;
                height: 100%;
                z-index: 1;
            }
            .testimoni-card::after {
                content: '';
                position: absolute;
                bottom: -20px; left: -20px;
                width: 120px; height: 120px;
                background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
                border-radius: 50%;
                z-index: -1;
            }
            .testimoni-card:hover {
                box-shadow: 0 20px 50px rgba(6, 49, 30, 0.3);
                transform: translateY(-8px);
            }
            .testimoni-card::before {
                content: '\201C';
                position: absolute;
                top: 10px; left: 18px;
                font-size: 5rem;
                color: rgba(255,255,255,0.1);
                font-family: Georgia, serif;
                line-height: 1;
                z-index: -1;
            }
            .star-rating { color: var(--icde-gold); font-size: 1rem; }
            .testimoni-avatar {
                width: 52px; height: 52px;
                border-radius: 50%;
                background: rgba(255,255,255,0.1);
                border: 2px solid rgba(255,255,255,0.2);
                display: flex; align-items: center; justify-content: center;
                color: #fff; font-size: 1.3rem;
                flex-shrink: 0;
            }
            .testimoni-text { color: rgba(255,255,255,0.95); font-size: 0.95rem; line-height: 1.8; position: relative; z-index: 1; flex-grow: 1; }
            .testimoni-name { font-weight: 700; font-size: 1rem; color: #fff; margin-bottom: 2px; }
            .testimoni-job { font-size: 0.8rem; color: rgba(255,255,255,0.8); }
            .testimoni-company { font-size: 0.8rem; color: var(--icde-gold-light); font-weight: 600; }
        </style>
        
        @if($testimoni->isEmpty())
        <div class="row g-4 d-flex align-items-stretch">
            @foreach([
                ['nama' => 'DR. Heru Santoso, M.Si', 'jabatan' => 'Kepala Bappeda', 'instansi' => 'Kota Semarang', 'bintang' => 5, 'isi' => 'PT ICDE telah membantu kami dalam menyusun RPJMD dengan sangat profesional. Metodologi yang digunakan sangat komprehensif dan hasilnya memuaskan. Tim yang berpengalaman dan responsif terhadap kebutuhan kami.'],
                ['nama' => 'Ir. Sari Dewi Pratiwi', 'jabatan' => 'Direktur Perencanaan', 'instansi' => 'Kementerian Desa PDTT', 'bintang' => 5, 'isi' => 'Kajian yang dihasilkan PT ICDE sangat berkualitas tinggi dan berbasis data yang akurat. Rekomendasi yang diberikan sangat actionable dan telah kami implementasikan dalam kebijakan.'],
                ['nama' => 'Drs. Ahmad Fauzan', 'jabatan' => 'Bupati', 'instansi' => 'Kabupaten Demak', 'bintang' => 5, 'isi' => 'Kami sangat puas dengan layanan PT ICDE dalam mendampingi penyusunan dokumen perencanaan daerah. Sangat profesional, tepat waktu, dan hasilnya sesuai dengan kebutuhan daerah kami.'],
                ['nama' => 'Prof. Dr. Rina Wulandari', 'jabatan' => 'Direktur Program', 'instansi' => 'UNDP Indonesia', 'bintang' => 5, 'isi' => 'PT ICDE adalah mitra penelitian yang sangat kompeten. Tim penelitinya memiliki kemampuan analisis yang tajam dan pemahaman mendalam tentang konteks pembangunan Indonesia.'],
                ['nama' => 'Arif Budiman, SE, MSc', 'jabatan' => 'Kepala Divisi CSR', 'instansi' => 'PT Wijaya Karya', 'bintang' => 4, 'isi' => 'Studi kelayakan yang dilakukan PT ICDE sangat komprehensif dan membantu perusahaan dalam mengambil keputusan investasi. Laporan yang dihasilkan detail dan mudah dipahami.'],
                ['nama' => 'Dra. Sri Mulyani, M.Si', 'jabatan' => 'Kepala Dinas Kesehatan', 'instansi' => 'Provinsi Jawa Tengah', 'bintang' => 5, 'isi' => 'Evaluasi program yang dilakukan PT ICDE sangat objektif dan independen. Temuan dan rekomendasinya membantu kami meningkatkan efektivitas program kesehatan masyarakat.'],
            ] as $idx => $t)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}">
                <div class="testimoni-card d-flex flex-column">
                    <div class="star-rating mb-3">
                        @for($i = 0; $i < $t['bintang']; $i++)
                        <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <div class="testimoni-text">{!! $t['isi'] !!}</div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="testimoni-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div class="testimoni-name">{{ $t['nama'] }}</div>
                            <div class="testimoni-job">{{ $t['jabatan'] }}</div>
                            <div class="testimoni-company">{{ $t['instansi'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4 d-flex align-items-stretch">
            @foreach($testimoni as $t)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="testimoni-card d-flex flex-column">
                    <div class="star-rating mb-3">
                        @for($i = 0; $i < $t->bintang; $i++)
                        <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <div class="testimoni-text">{!! $t->isi !!}</div>
                    <div class="d-flex align-items-center gap-3 mt-4">
                        <div class="testimoni-avatar" style="overflow:hidden;">
                            @if($t->foto)
                            <img src="{{ asset('storage/' . $t->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                            <i class="bi bi-person-fill"></i>
                            @endif
                        </div>
                        <div>
                            <div class="testimoni-name">{{ $t->nama }}</div>
                            @if($t->jabatan)<div class="testimoni-job">{{ $t->jabatan }}</div>@endif
                            @if($t->instansi)<div class="testimoni-company">{{ $t->instansi }}</div>@endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $testimoni->links() }}
        </div>
        @endif
    </div>
</section>

@endsection
