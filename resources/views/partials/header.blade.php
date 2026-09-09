@php
  $header = setting_array('header', \App\Support\LayoutContent::header());
  $whats = setting('whatsapp', '');
  $currentPath = '/'.trim(request()->path() === '/' ? '' : request()->path(), '/');
@endphp

<header class="site-header {{ $solidHeader ?? false ? 'is-solid' : '' }}" id="site-header">
  <div class="container header-inner">
    <a class="brand" href="{{ url('/') }}">
      @if (!empty($header['logo']))
        <img src="{{ media_url($header['logo']) }}" alt="{{ $header['logo_alt'] ?? $header['brand_name'] ?? '' }}" width="52" height="52" />
      @endif
      <span>
        <strong>{{ $header['brand_name'] ?? '' }}</strong>
        <small>{{ $header['brand_subtitle'] ?? '' }}</small>
      </span>
    </a>

    <button class="nav-toggle" id="nav-toggle" aria-expanded="false" aria-controls="main-nav">
      <span class="nav-toggle-bar"></span>
      <span class="sr-only">Abrir menu</span>
    </button>

    <nav class="main-nav" id="main-nav" aria-label="Menu principal">
      @foreach ($header['menu'] ?? [] as $item)
        @php
          $url = $item['url'] ?? '#';
          $path = parse_url($url, PHP_URL_PATH);
          $isCurrent = ! str_contains($url, '#')
            && $path !== null && $path !== ''
            && rtrim($path, '/') === rtrim($currentPath, '/');
        @endphp
        <a @class(['is-current' => $isCurrent]) href="{{ $url }}">{{ $item['label'] ?? '' }}</a>
      @endforeach
      @if ($whats)
        <a class="btn btn-whats nav-cta" href="{{ wa_url($whats, $header['whatsapp_text'] ?? '') }}" target="_blank" rel="noopener">{{ $header['whatsapp_label'] ?? 'WhatsApp' }}</a>
      @endif
    </nav>
  </div>
</header>
