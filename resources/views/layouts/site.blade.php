<!doctype html>
<html lang="pt-BR">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ $page->seoTitle() }}</title>
    @if ($page->seoDescription())
      <meta name="description" content="{{ $page->seoDescription() }}" />
    @endif
    <meta name="robots" content="{{ $page->robots ?: 'index,follow' }}" />
    <link rel="canonical" href="{{ $page->seoCanonical() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ $page->seoCanonical() }}" />
    <meta property="og:title" content="{{ $page->og_title ?: $page->seoTitle() }}" />
    @if ($page->og_description ?: $page->seoDescription())
      <meta property="og:description" content="{{ $page->og_description ?: $page->seoDescription() }}" />
    @endif
    @php
      $ogImage = $page->og_image ?: ($page->section('hero.image') ?: ($page->section('hero.slides.0.image') ?: setting('og_image')));
    @endphp
    @if ($ogImage)
      <meta property="og:image" content="{{ media_url($ogImage) }}" />
      <meta name="twitter:card" content="summary_large_image" />
      <meta name="twitter:image" content="{{ media_url($ogImage) }}" />
    @endif
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Sora:wght@600;700;800&family=Inter:wght@400;500;600&display=swap"
    />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @if (!empty($settings['ga_enabled']) && filter_var($settings['ga_enabled'], FILTER_VALIDATE_BOOLEAN) && !empty($settings['ga_measurement_id']))
      <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['ga_measurement_id'] }}"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', @json($settings['ga_measurement_id']));
      </script>
    @endif
    @stack('head')
  </head>
  <body data-whatsapp="{{ $settings['whatsapp'] ?? '' }}">
    <a class="skip-link" href="#top">Ir para o conteúdo</a>

    @include('partials.header', ['solidHeader' => ! in_array($page->template, ['home', 'landing'], true)])

    @yield('content')

    @include('partials.footer')
    @include('partials.cookie-banner')

    <div class="lightbox" id="lightbox" hidden>
      <button class="lightbox-close" id="lightbox-close" aria-label="Fechar">&times;</button>
      <img id="lightbox-img" src="" alt="Imagem ampliada da galeria" />
    </div>

    @php
      $ldPhones = array_values(array_filter(array_map(
        fn ($p) => $p['tel'] ?? null,
        $page->section('contact.phones', [])
      )));
      if ($ldPhones === [] && !empty($settings['whatsapp'])) {
          $ldPhones = ['+'.$settings['whatsapp']];
      }
      $jsonLd = [
        '@context' => 'https://schema.org',
        '@type' => 'LocalBusiness',
        'name' => $settings['site_name'] ?? $page->title,
        'description' => $page->seoDescription() ?: ($settings['jsonld_description'] ?? null),
        'telephone' => $ldPhones,
        'email' => $settings['email'] ?? null,
        'address' => [
          '@type' => 'PostalAddress',
          'streetAddress' => $settings['address'] ?? null,
          'postalCode' => $settings['postal_code'] ?? null,
          'addressLocality' => $settings['city'] ?? 'Fortaleza',
          'addressRegion' => $settings['region'] ?? 'CE',
          'addressCountry' => 'BR',
        ],
        'areaServed' => $settings['area_served'] ?? 'Ceará',
        'image' => $ogImage ? media_url($ogImage) : null,
      ];
    @endphp
    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    <script src="{{ asset('js/main.js') }}" defer></script>
  </body>
</html>
