@extends('layouts.app')

@section('title', 'SDM - PT ICDE')

@push('styles')
<style>
    .sdm-section-title {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 32px;
    }
    .sdm-section-title h3 {
        font-weight: 800;
        font-size: 1.75rem;
        color: var(--icde-navy-dark);
        margin: 0;
        white-space: nowrap;
    }
    .sdm-section-title::after {
        content: '';
        flex: 1;
        height: 2px;
        background: linear-gradient(90deg, var(--icde-primary), transparent);
        border-radius: 2px;
    }
    .sdm-category-icon {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--icde-primary), var(--icde-primary-light));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .sdm-card {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.07);
        transition: all 0.3s;
        background: #fff;
        height: 100%;
    }
    .sdm-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 40px rgba(0,0,0,0.13);
    }
    .sdm-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .sdm-avatar-placeholder {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 2.5rem;
        border: 4px solid rgba(255,255,255,0.3);
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .sdm-header-komisaris {
        background: linear-gradient(135deg, #1a3a5c, #2d6a9f);
        padding: 30px 20px 40px;
        text-align: center;
    }
    .sdm-header-direksi {
        background: linear-gradient(135deg, var(--icde-primary), var(--icde-primary-light));
        padding: 30px 20px 40px;
        text-align: center;
    }
    .sdm-header-tenaga-ahli {
        background: linear-gradient(135deg, #0d7377, #14a3a8);
        padding: 30px 20px 40px;
        text-align: center;
    }
    .sdm-body { padding: 20px; text-align: center; }
    .jabatan-badge {
        display: inline-block;
        padding: 5px 16px;
        border-radius: 20px;
        font-size: 0.88rem;
        font-weight: 700;
    }
    .jabatan-badge-komisaris {
        background: rgba(26,58,92,0.1);
        color: #1a3a5c;
    }
    .jabatan-badge-direksi {
        background: rgba(27,108,168,0.1);
        color: var(--icde-primary);
    }
    .jabatan-badge-tenaga-ahli {
        background: rgba(13,115,119,0.1);
        color: #0d7377;
    }
    .sdm-info-item {
        font-size: 0.95rem;
        font-weight: 500;
        color: #475569;
    }
    .sdm-info-item i {
        margin-right: 4px;
    }
    .sdm-category-block {
        margin-bottom: 50px;
    }
    .sdm-category-block:last-child {
        margin-bottom: 0;
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <h1 data-aos="fade-right">{{ \App\Models\Setting::get('page_sdm_title', 'Sumber Daya Manusia') }}</h1>
        <nav aria-label="breadcrumb" data-aos="fade-right" data-aos-delay="100">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
                <li class="breadcrumb-item active">{{ \App\Models\Setting::get('page_sdm_title', 'Sumber Daya Manusia') }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="section">
    <div class="container">


        @php
            $categories = [
                'Komisaris'    => ['icon' => 'bi-shield-check',   'header' => 'sdm-header-komisaris',    'badge' => 'jabatan-badge-komisaris'],
                'Direksi'      => ['icon' => 'bi-briefcase-fill', 'header' => 'sdm-header-direksi',      'badge' => 'jabatan-badge-direksi'],
                'Tenaga Ahli'  => ['icon' => 'bi-person-gear',    'header' => 'sdm-header-tenaga-ahli',  'badge' => 'jabatan-badge-tenaga-ahli'],
            ];
            $grouped = $sdm->groupBy(function($item) {
                $jab = strtolower($item->jabatan ?? '');
                if (str_contains($jab, 'komisaris')) return 'Komisaris';
                if (str_contains($jab, 'direk') || str_contains($jab, 'sekretaris')) return 'Direksi';
                if (str_contains($jab, 'ahli')) return 'Tenaga Ahli';
                return 'Lainnya';
            });
        @endphp

        @foreach($categories as $category => $style)
            @if(isset($grouped[$category]) && $grouped[$category]->count() > 0)
            <div class="sdm-category-block" data-aos="fade-up">
                <div class="sdm-section-title">
                    <div class="sdm-category-icon">
                        <i class="bi {{ $style['icon'] }}"></i>
                    </div>
                    <h3>{{ $category }}</h3>
                </div>
                <div class="row g-4 justify-content-center">
                    @foreach($grouped[$category] as $idx => $person)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}">
                        <div class="sdm-card">
                            <div class="{{ $style['header'] }}">
                                @if($person->foto)
                                <img src="{{ asset('storage/' . $person->foto) }}" class="sdm-avatar mx-auto d-block" alt="{{ $person->nama }}">
                                @else
                                <div class="sdm-avatar-placeholder mx-auto">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                                @endif
                            </div>
                            <div class="sdm-body">
                                <h5 style="font-weight:800;font-size:1.15rem;color:var(--icde-navy-dark);margin-bottom:8px;">{{ $person->nama }}</h5>
                                <span class="jabatan-badge {{ $style['badge'] }}">{{ $person->jabatan }}</span>
                                @if($person->pendidikan)
                                <div class="mt-3 sdm-info-item">
                                    <i class="bi bi-mortarboard"></i>{{ $person->pendidikan }}
                                </div>
                                @endif
                                @if($person->keahlian)
                                <div class="mt-2 sdm-info-item">
                                    <i class="bi bi-tools"></i>{{ $person->keahlian }}
                                </div>
                                @endif
                                @if($person->deskripsi)
                                <div class="mt-3" style="font-size:0.95rem;color:#334155;font-weight:500;line-height:1.7;">{!! $person->deskripsi !!}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        @endforeach

        {{-- Fallback: tampilkan SDM yang jabatannya tidak masuk kategori di atas --}}
        @php
            $others = collect($grouped->get('Lainnya', []));
        @endphp
        @if($others->count() > 0)
        <div class="sdm-category-block" data-aos="fade-up">
            <div class="sdm-section-title">
                <div class="sdm-category-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h3>Lainnya</h3>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach($others as $idx => $person)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($idx % 3) * 100 }}">
                    <div class="sdm-card">
                        <div class="sdm-header-direksi">
                            @if($person->foto)
                            <img src="{{ asset('storage/' . $person->foto) }}" class="sdm-avatar mx-auto d-block" alt="{{ $person->nama }}">
                            @else
                            <div class="sdm-avatar-placeholder mx-auto">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            @endif
                        </div>
                        <div class="sdm-body">
                            <h5 style="font-weight:800;font-size:1.15rem;color:var(--icde-navy-dark);margin-bottom:8px;">{{ $person->nama }}</h5>
                            <span class="jabatan-badge jabatan-badge-direksi">{{ $person->jabatan }}</span>
                            @if($person->pendidikan)
                            <div class="mt-3 sdm-info-item">
                                <i class="bi bi-mortarboard"></i>{{ $person->pendidikan }}
                            </div>
                            @endif
                            @if($person->keahlian)
                            <div class="mt-2 sdm-info-item">
                                <i class="bi bi-tools"></i>{{ $person->keahlian }}
                            </div>
                            @endif
                            @if($person->deskripsi)
                            <div class="mt-3" style="font-size:0.95rem;color:#334155;font-weight:500;line-height:1.7;">{!! $person->deskripsi !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
