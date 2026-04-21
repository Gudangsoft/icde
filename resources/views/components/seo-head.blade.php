@props(['title' => null, 'description' => null, 'keywords' => null, 'image' => null])

@php
    $rawTitle = $title ?: trim($__env->yieldContent('title'));
    $titleContent = $rawTitle ? $rawTitle . ' - ' . ($settings['site_name'] ?? 'PT ICDE') : (($settings['site_name'] ?? 'PT ICDE') . ' - ' . ($settings['site_tagline'] ?? 'Konsultan Profesional'));
    
    $rawDesc = $description ?: trim($__env->yieldContent('meta_description'));
    $descContent = $rawDesc ? $rawDesc : ($settings['site_description'] ?? 'PT ICDE adalah konsultan profesional di bidang perencanaan, evaluasi pembangunan, penelitian dan kajian berbasis data.');
    
    $finalKeywords = $keywords ?: ($settings['site_keywords'] ?? '');
    
    $defaultImage = !empty($settings['site_logo']) ? asset('storage/' . $settings['site_logo']) : asset('images/logo-icde.png');
    $rawImage = $image ?: trim($__env->yieldContent('meta_image'));
    $imageContent = $rawImage ? $rawImage : $defaultImage;
    
    $siteName = $settings['site_name'] ?? 'PT ICDE';
@endphp

{{-- Basic Meta Tags --}}
<title>{{ $titleContent }}</title>
<meta name="description" content="{{ $descContent }}">
@if($finalKeywords)
    <meta name="keywords" content="{{ $finalKeywords }}">
@endif
@if(!empty($settings['meta_author']))
    <meta name="author" content="{{ $settings['meta_author'] }}">
@endif
@if(!empty($settings['site_favicon']))
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $settings['site_favicon']) }}">
@endif

{{-- Open Graph Meta Tags --}}
<meta property="og:title" content="{{ $titleContent }}">
<meta property="og:description" content="{{ $descContent }}">
<meta property="og:type" content="website">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $imageContent }}">
<meta property="og:site_name" content="{{ $siteName }}">

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $titleContent }}">
<meta name="twitter:description" content="{{ $descContent }}">
<meta name="twitter:image" content="{{ $imageContent }}">

{{-- Additional SEO Meta Tags --}}
<meta name="robots" content="index,follow">
<link rel="canonical" href="{{ url()->current() }}">

{{-- Schema.org Structured Data --}}
@php
    $schema = [
        "@context" => "https://schema.org",
        "@type" => "Organization",
        "name" => $siteName,
        "url" => url('/'),
        "logo" => $defaultImage,
    ];

    if (!empty($settings['site_phone'])) {
        $schema['telephone'] = $settings['site_phone'];
    }
    if (!empty($settings['site_email'])) {
        $schema['email'] = $settings['site_email'];
    }
    if (!empty($settings['site_address'])) {
        $schema['address'] = [
            "@type" => "PostalAddress",
            "streetAddress" => $settings['site_address']
        ];
    }

    $sameAs = array_values(array_filter([
        $settings['social_facebook'] ?? null,
        $settings['social_twitter'] ?? null,
        $settings['social_linkedin'] ?? null,
        $settings['social_instagram'] ?? null,
        $settings['social_youtube'] ?? null
    ]));
    if (!empty($sameAs)) {
        $schema['sameAs'] = $sameAs;
    }
@endphp
<script type="application/ld+json">
    {!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) !!}
</script>
