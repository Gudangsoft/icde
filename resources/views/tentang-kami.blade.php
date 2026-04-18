@extends('layouts.app')

@section('title', 'Tentang Kami - PT ICDE')
@section('meta_description', 'Tentang PT ICDE - Profil, visi, misi, dan nilai perusahaan konsultan perencanaan pembangunan Semarang.')

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">Tentang Kami</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item active">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>

<!-- PROFIL -->
<section class="section">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                @if(!empty($tentang->gambar))
                    <img src="{{ asset('storage/' . $tentang->gambar) }}" class="rounded shadow-lg w-100" style="aspect-ratio:4/3; object-fit:cover;" alt="Profil Perusahaan">
                @else
                    <div class="rounded shadow-lg d-flex align-items-center justify-content-center"
                         style="width:100%;aspect-ratio:4/3;background:linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark));">
                        <div class="text-center text-white p-4">
                            <i class="bi bi-buildings-fill mb-3 opacity-75" style="font-size: 4rem;"></i>
                            <div class="fw-bold fs-5">{{ $tentang->nama_lengkap ?? $tentang->nama_perusahaan ?? 'PT ICDE Semarang' }}</div>
                            <div class="small opacity-75 mt-2">Professional Consultant</div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="section-title" style="text-align: left;">{{ $tentang->judul ?? 'PT ICDE Semarang' }}</h2>
                
                <div style="color:#334155; line-height:1.85; font-size:1.1rem; font-weight:500; text-align:justify;">
                    @if(!empty($tentang->deskripsi))
                        {!! $tentang->deskripsi !!}
                    @else
                        <p>PT. ICDE adalah konsultan profesional di bidang perencanaan, evaluasi pembangunan, penelitian dan kajian berbasis data, menghadirkan analisis tajam untuk menghasilkan kebijakan yang tepat, terukur, dan berdampak nyata.</p>
                        <p>Didirikan sejak 1999, PT ICDE telah berkontribusi dalam ratusan proyek pembangunan di berbagai wilayah Indonesia. Dengan dukungan tim multidisiplin yang berpengalaman dan metodologi berbasis bukti, kami berkomitmen untuk menjadi mitra strategis pembangunan yang terpercaya.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<!-- VISI MISI -->
<section class="section section-alt" style="background:var(--icde-light-bg);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">Visi & Misi</h2>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Visi Card -->
                <div class="card border-0 shadow-lg mb-5" data-aos="fade-up" data-aos-delay="100" style="border-radius: 24px; overflow: hidden; background: linear-gradient(135deg, var(--icde-primary), var(--icde-navy-dark)); color: white; position: relative;">
                    <!-- Dekorasi Background -->
                    <i class="bi bi-eye-fill position-absolute" style="font-size: 12rem; opacity: 0.05; top: -30px; right: 10px; transform: rotate(-10deg);"></i>
                    <i class="bi bi-stars position-absolute" style="font-size: 3rem; opacity: 0.15; bottom: 20px; left: 30px;"></i>
                    
                    <div class="p-5 p-md-5 text-center position-relative z-1">
                        <div class="d-inline-flex align-items-center justify-content-center mb-4" style="width: 76px; height: 76px; background: rgba(255,255,255,0.1); border-radius: 50%; border: 1px solid rgba(255,255,255,0.2); backdrop-filter: blur(10px); box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                            <i class="bi bi-eye-fill text-white fs-1"></i>
                        </div>
                        <h3 class="fw-bold mb-4" style="letter-spacing: 1px;">Visi Perusahaan</h3>
                        
                        <div class="visi-text mx-auto" style="max-width: 800px; font-size: 1.35rem; line-height: 1.8; font-weight: 500; font-style: italic; opacity: 1;">
                            @if(!empty($tentang->visi))
                                {!! $tentang->visi !!}
                            @else
                                <p>Menjadi perusahaan konsultan terkemuka di Indonesia yang dipercaya dalam memberikan solusi perencanaan dan evaluasi pembangunan yang berkualitas, inovatif, dan berdampak nyata bagi masyarakat.</p>
                            @endif
                        </div>
                        <style>
                            .visi-text p { margin-bottom: 0; }
                            .visi-text p:last-child { margin-bottom: 0; }
                        </style>
                    </div>
                </div>

                <!-- Misi Card -->
                <div class="card border-0 shadow-sm" data-aos="fade-up" data-aos-delay="200" style="border-radius: 24px; background: #fff; overflow: hidden;">
                    <div class="p-5 p-md-5">
                        <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-4">
                            <div class="d-flex align-items-center justify-content-center me-4" style="width: 70px; height: 70px; background: linear-gradient(135deg, rgba(132,204,22,0.15), rgba(29,145,94,0.1)); border-radius: 20px; border: 1px solid rgba(132,204,22,0.2);">
                                <i class="bi bi-bullseye" style="font-size: 2rem; color: var(--icde-secondary);"></i>
                            </div>
                            <h3 class="fw-bold mb-0" style="color: var(--icde-primary);">Misi Kami</h3>
                        </div>
                        
                        <div class="misi-text" style="line-height: 1.9; font-size: 1.1rem; font-weight: 500; color: #334155;">
                            @if(!empty($tentang->misi))
                                {!! $tentang->misi !!}
                            @else
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex"><i class="bi bi-check2-circle me-3 mt-1" style="color:var(--icde-secondary); font-size:1.4rem;"></i><span>Menyediakan layanan konsultansi perencanaan dan evaluasi pembangunan yang berkualitas.</span></li>
                                    <li class="mb-3 d-flex"><i class="bi bi-check2-circle me-3 mt-1" style="color:var(--icde-secondary); font-size:1.4rem;"></i><span>Mengembangkan SDM yang profesional, kompeten, dan berintegritas tinggi.</span></li>
                                    <li class="mb-3 d-flex"><i class="bi bi-check2-circle me-3 mt-1" style="color:var(--icde-secondary); font-size:1.4rem;"></i><span>Menerapkan metodologi penelitian berbasis data yang ilmiah dan terstandar.</span></li>
                                    <li class="mb-3 d-flex"><i class="bi bi-check2-circle me-3 mt-1" style="color:var(--icde-secondary); font-size:1.4rem;"></i><span>Berkontribusi aktif dalam peningkatan kualitas kebijakan pembangunan nasional dan daerah.</span></li>
                                </ul>
                            @endif
                        </div>
                        <style>
                            .misi-text ul, .misi-text ol { padding-left: 1.5rem; margin-bottom: 0; }
                            .misi-text li { margin-bottom: 12px; }
                            /* Merapikan jika admin menggunakan line break <br> alih-alih list */
                            .misi-text p { margin-bottom: 15px; }
                            .misi-text p:last-child { margin-bottom: 0; }
                        </style>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</section>

{{-- STRUKTUR ORGANISASI --}}
@if($struktur->isNotEmpty())
<section class="section">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center">{{ \App\Models\Setting::get('page_struktur_title', 'Struktur Organisasi') }}</h2>
        </div>

        <div style="overflow-x:auto;padding-bottom:20px;">
        @foreach($struktur as $root)
        {{-- ROOT level --}}
        <div style="display:flex;flex-direction:column;align-items:center;" data-aos="fade-up">

            {{-- ROOT BOX --}}
            <div style="background:#fff;border-top:4px solid var(--icde-primary);border-radius:12px;box-shadow:0 4px 18px rgba(0,0,0,0.09);padding:18px 28px;min-width:180px;max-width:240px;text-align:center;">
                @if($root->foto)
                <img src="{{ asset('storage/'.$root->foto) }}" style="width:60px;height:60px;border-radius:50%;object-fit:cover;border:3px solid var(--icde-primary);margin-bottom:8px;">
                @else
                <div style="width:60px;height:60px;border-radius:50%;background:rgba(27,108,168,0.1);border:3px solid var(--icde-primary);display:flex;align-items:center;justify-content:center;margin:0 auto 8px;font-size:1.6rem;color:var(--icde-primary);"><i class="bi bi-person-fill"></i></div>
                @endif
                <div style="font-weight:700;font-size:0.9rem;color:#1e293b;">{{ $root->nama ?: $root->jabatan }}</div>
                @if($root->gelar)<div style="font-size:0.72rem;color:#94a3b8;">{{ $root->gelar }}</div>@endif
                <span style="display:inline-block;background:rgba(27,108,168,0.12);color:var(--icde-primary);font-size:0.7rem;font-weight:700;padding:3px 12px;border-radius:10px;margin-top:6px;">{{ $root->jabatan }}</span>
            </div>

            @if($root->children->where('aktif',true)->isNotEmpty())
            <div style="width:2px;height:28px;background:#cbd5e1;"></div>

            {{-- LEVEL 2 row --}}
            <div style="display:flex;align-items:flex-start;justify-content:center;gap:0;position:relative;width:100%;">
                {{-- horizontal connector --}}
                @if($root->children->where('aktif',true)->count() > 1)
                <div style="position:absolute;top:0;left:25%;right:25%;height:2px;background:#cbd5e1;"></div>
                @endif

                @foreach($root->children->where('aktif',true) as $lvl2)
                <div style="display:flex;flex-direction:column;align-items:center;flex:1;padding:0 8px;min-width:180px;">
                    <div style="width:2px;height:28px;background:#cbd5e1;"></div>

                    {{-- LVL2 BOX --}}
                    <div style="background:#fff;border-top:4px solid var(--icde-secondary);border-radius:12px;box-shadow:0 4px 18px rgba(0,0,0,0.08);padding:16px 20px;min-width:160px;max-width:220px;text-align:center;width:100%;">
                        @if($lvl2->foto)
                        <img src="{{ asset('storage/'.$lvl2->foto) }}" style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:3px solid var(--icde-secondary);margin-bottom:8px;">
                        @else
                        <div style="width:52px;height:52px;border-radius:50%;background:rgba(132,204,22,0.1);border:3px solid var(--icde-secondary);display:flex;align-items:center;justify-content:center;margin:0 auto 8px;font-size:1.3rem;color:var(--icde-secondary);"><i class="bi bi-person-fill"></i></div>
                        @endif
                        <div style="font-weight:700;font-size:0.85rem;color:#1e293b;">{{ $lvl2->nama ?: $lvl2->jabatan }}</div>
                        @if($lvl2->gelar)<div style="font-size:0.7rem;color:#94a3b8;">{{ $lvl2->gelar }}</div>@endif
                        <span style="display:inline-block;background:rgba(132,204,22,0.15);color:#4d7c0f;font-size:0.68rem;font-weight:700;padding:3px 10px;border-radius:10px;margin-top:6px;">{{ $lvl2->jabatan }}</span>
                    </div>

                    @if($lvl2->children->where('aktif',true)->isNotEmpty())
                    <div style="width:2px;height:24px;background:#cbd5e1;"></div>

                    {{-- LEVEL 3 row --}}
                    <div style="display:flex;align-items:flex-start;justify-content:center;gap:0;position:relative;width:100%;">
                        @if($lvl2->children->where('aktif',true)->count() > 1)
                        <div style="position:absolute;top:0;left:20%;right:20%;height:2px;background:#cbd5e1;"></div>
                        @endif

                        @foreach($lvl2->children->where('aktif',true) as $lvl3)
                        <div style="display:flex;flex-direction:column;align-items:center;flex:1;padding:0 6px;min-width:140px;">
                            <div style="width:2px;height:24px;background:#cbd5e1;"></div>

                            {{-- LVL3 BOX --}}
                            <div style="background:#fff;border-top:4px solid var(--icde-navy-light);border-radius:10px;box-shadow:0 3px 12px rgba(0,0,0,0.07);padding:14px 16px;text-align:center;width:100%;max-width:200px;">
                                @if($lvl3->foto)
                                <img src="{{ asset('storage/'.$lvl3->foto) }}" style="width:46px;height:46px;border-radius:50%;object-fit:cover;border:2px solid var(--icde-navy-light);margin-bottom:6px;">
                                @else
                                <div style="width:46px;height:46px;border-radius:50%;background:rgba(29,145,94,0.1);border:2px solid var(--icde-navy-light);display:flex;align-items:center;justify-content:center;margin:0 auto 6px;font-size:1.1rem;color:var(--icde-navy-light);"><i class="bi bi-person-fill"></i></div>
                                @endif
                                <div style="font-weight:700;font-size:0.8rem;color:#1e293b;">{{ $lvl3->nama ?: $lvl3->jabatan }}</div>
                                @if($lvl3->gelar)<div style="font-size:0.68rem;color:#94a3b8;">{{ $lvl3->gelar }}</div>@endif
                                <span style="display:inline-block;background:rgba(29,145,94,0.12);color:var(--icde-navy-dark);font-size:0.65rem;font-weight:700;padding:2px 8px;border-radius:8px;margin-top:5px;">{{ $lvl3->jabatan }}</span>

                                {{-- LEVEL 4 stacked inside card --}}
                                @if($lvl3->children->where('aktif',true)->isNotEmpty())
                                <div style="margin-top:10px;padding-top:10px;border-top:1px dashed #e2e8f0;">
                                    @foreach($lvl3->children->where('aktif',true) as $lvl4)
                                    <div style="background:#f8fafc;border-radius:8px;padding:8px 10px;margin-top:6px;text-align:left;">
                                        <div style="font-size:0.72rem;font-weight:700;color:#475569;">{{ $lvl4->jabatan }}</div>
                                        @if($lvl4->nama && $lvl4->nama !== $lvl4->jabatan)
                                        <div style="font-size:0.68rem;color:#94a3b8;">{{ $lvl4->nama }}{{ $lvl4->gelar ? ', '.$lvl4->gelar : '' }}</div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
            @endif

        </div>
        @endforeach
        </div>
    </div>
</section>
@endif

{{-- DATA PERUSAHAAN (LEGALITAS) --}}
@php
$hasDataPerusahaan = $tentang && ($tentang->npwp || $tentang->nib || $tentang->akta_nomor || $tentang->kadin_nomor || $tentang->pengesahan_badan_hukum);
@endphp
@if($hasDataPerusahaan)
<section class="section section-alt" style="background:#f8fafc;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title text-center" style="color: var(--icde-primary); font-weight: 800;">Legalitas Perusahaan</h2>
        </div>
        
        <div class="row g-4 justify-content-center">
            
            {{-- Akte Pendirian --}}
            @if($tentang->akta_notaris || $tentang->akta_nomor)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Akte Pendirian</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        @if($tentang->akta_notaris) Notaris : {{ $tentang->akta_notaris }} @if($tentang->akta_nomor) Nomor: {{ $tentang->akta_nomor }} @endif <br>@endif
                        @if($tentang->akta_tanggal) Tanggal : {{ $tentang->akta_tanggal }} @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- SK Kemenkumham --}}
            @if($tentang->pengesahan_badan_hukum)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">SK Pengesahan Badan Hukum Kepmenkumham</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        Nomor : {{ $tentang->pengesahan_badan_hukum }}
                    </div>
                </div>
            </div>
            @endif

            {{-- Noreg KADIN --}}
            @if($tentang->kadin_nomor)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Noreg KADIN</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        Nomor : {{ $tentang->kadin_nomor }}
                        @if($tentang->kadin_berlaku)<br> Berlaku s/d : {{ $tentang->kadin_berlaku }} @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- NPWP --}}
            @if($tentang->npwp)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">NPWP</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        Nomor : {{ $tentang->npwp }}
                    </div>
                </div>
            </div>
            @endif

            {{-- NIB --}}
            @if($tentang->nib)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">NIB</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        Nomor : {{ $tentang->nib }}
                    </div>
                </div>
            </div>
            @endif

            {{-- KBLI --}}
            @if($tentang->kbli)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="550">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Izin Usaha Industri & KBLI</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        Kode : {{ $tentang->kbli }}
                    </div>
                </div>
            </div>
            @endif

            {{-- INKINDO --}}
            @if($tentang->inkindo_nomor)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">Noreg INKINDO</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        Provinsi Jawa Tengah<br>
                        Nomor : {{ $tentang->inkindo_nomor }}
                        @if($tentang->inkindo_berlaku)<br> Berlaku s/d : {{ $tentang->inkindo_berlaku }} @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- SIUP/OSS --}}
            @if($tentang->siup_tanggal)
            <div class="col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="700">
                <div class="card h-100 border-0 shadow-sm text-center" style="border-radius: 8px; padding: 30px 20px;">
                    <div style="width: 54px; height: 54px; background: var(--icde-navy-dark); border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin: 0 auto 20px;">
                        <i class="bi bi-file-earmark-text-fill text-white fs-4"></i>
                    </div>
                    <div style="font-size: 0.95rem; font-weight: 600; color: #334155; margin-bottom: 8px;">SIUP / OSS</div>
                    <div style="font-size: 1.05rem; font-weight: 800; color: var(--icde-navy-dark); line-height: 1.6;">
                        Tanggal : {{ $tentang->siup_tanggal }}
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</section>
@endif

@endsection
