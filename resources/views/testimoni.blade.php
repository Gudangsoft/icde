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

        @if($testimoni->isEmpty())
        <div class="row g-4">
            @foreach([
                ['nama' => 'DR. Heru Santoso, M.Si', 'jabatan' => 'Kepala Bappeda', 'instansi' => 'Kota Semarang', 'bintang' => 5, 'isi' => 'PT ICDE telah membantu kami dalam menyusun RPJMD dengan sangat profesional. Metodologi yang digunakan sangat komprehensif dan hasilnya memuaskan. Tim yang berpengalaman dan responsif terhadap kebutuhan kami.'],
                ['nama' => 'Ir. Sari Dewi Pratiwi', 'jabatan' => 'Direktur Perencanaan', 'instansi' => 'Kementerian Desa PDTT', 'bintang' => 5, 'isi' => 'Kajian yang dihasilkan PT ICDE sangat berkualitas tinggi dan berbasis data yang akurat. Rekomendasi yang diberikan sangat actionable dan telah kami implementasikan dalam kebijakan.'],
                ['nama' => 'Drs. Ahmad Fauzan', 'jabatan' => 'Bupati', 'instansi' => 'Kabupaten Demak', 'bintang' => 5, 'isi' => 'Kami sangat puas dengan layanan PT ICDE dalam mendampingi penyusunan dokumen perencanaan daerah. Sangat profesional, tepat waktu, dan hasilnya sesuai dengan kebutuhan daerah kami.'],
                ['nama' => 'Prof. Dr. Rina Wulandari', 'jabatan' => 'Direktur Program', 'instansi' => 'UNDP Indonesia', 'bintang' => 5, 'isi' => 'PT ICDE adalah mitra penelitian yang sangat kompeten. Tim penelitinya memiliki kemampuan analisis yang tajam dan pemahaman mendalam tentang konteks pembangunan Indonesia.'],
                ['nama' => 'Arif Budiman, SE, MSc', 'jabatan' => 'Kepala Divisi CSR', 'instansi' => 'PT Wijaya Karya', 'bintang' => 4, 'isi' => 'Studi kelayakan yang dilakukan PT ICDE sangat komprehensif dan membantu perusahaan dalam mengambil keputusan investasi. Laporan yang dihasilkan detail dan mudah dipahami.'],
                ['nama' => 'Dra. Sri Mulyani, M.Si', 'jabatan' => 'Kepala Dinas Kesehatan', 'instansi' => 'Provinsi Jawa Tengah', 'bintang' => 5, 'isi' => 'Evaluasi program yang dilakukan PT ICDE sangat objektif dan independen. Temuan dan rekomendasinya membantu kami meningkatkan efektivitas program kesehatan masyarakat.'],
            ] as $idx => $t)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}">
                <div class="card" style="border:none;border-radius:16px;padding:30px;box-shadow:0 4px 20px rgba(0,0,0,0.07);position:relative;height:100%;">
                    <div style="position:absolute;top:15px;left:20px;font-size:5rem;color:rgba(27,108,168,0.06);font-family:Georgia,serif;line-height:1;">"</div>
                    <div style="color:#f5a623;font-size:0.9rem;margin-bottom:12px;position:relative;z-index:1;">
                        @for($i = 0; $i < $t['bintang']; $i++)
                        <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <div style="font-size:0.9rem;color:#555;line-height:1.8;position:relative;z-index:1;flex-grow:1;">{!! $t['isi'] !!}</div>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <div style="width:52px;height:52px;border-radius:50%;background:var(--icde-primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.3rem;flex-shrink:0;">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.9rem;">{{ $t['nama'] }}</div>
                            <div style="font-size:0.78rem;color:var(--icde-gray);">{{ $t['jabatan'] }}</div>
                            <div style="font-size:0.78rem;color:var(--icde-primary);font-weight:600;">{{ $t['instansi'] }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            @foreach($testimoni as $t)
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 100 }}">
                <div class="card" style="border:none;border-radius:16px;padding:30px;box-shadow:0 4px 20px rgba(0,0,0,0.07);position:relative;height:100%;">
                    <div style="position:absolute;top:15px;left:20px;font-size:5rem;color:rgba(27,108,168,0.06);font-family:Georgia,serif;line-height:1;">"</div>
                    <div style="color:#f5a623;font-size:0.9rem;margin-bottom:12px;position:relative;z-index:1;">
                        @for($i = 0; $i < $t->bintang; $i++)
                        <i class="bi bi-star-fill"></i>
                        @endfor
                    </div>
                    <div style="font-size:0.9rem;color:#555;line-height:1.8;position:relative;z-index:1;">{!! $t->isi !!}</div>
                    <div class="d-flex align-items-center gap-3 mt-3">
                        <div style="width:52px;height:52px;border-radius:50%;background:var(--icde-primary);display:flex;align-items:center;justify-content:center;color:#fff;font-size:1.3rem;flex-shrink:0;overflow:hidden;">
                            @if($t->foto)
                            <img src="{{ asset('storage/' . $t->foto) }}" style="width:100%;height:100%;object-fit:cover;">
                            @else
                            <i class="bi bi-person-fill"></i>
                            @endif
                        </div>
                        <div>
                            <div style="font-weight:700;font-size:0.9rem;">{{ $t->nama }}</div>
                            @if($t->jabatan)<div style="font-size:0.78rem;color:var(--icde-gray);">{{ $t->jabatan }}</div>@endif
                            @if($t->instansi)<div style="font-size:0.78rem;color:var(--icde-primary);font-weight:600;">{{ $t->instansi }}</div>@endif
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
