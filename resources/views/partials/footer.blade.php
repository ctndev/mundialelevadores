@php
  $footer = setting_array('footer', \App\Support\LayoutContent::footer());
  $whats = setting('whatsapp', '');
@endphp

<footer class="site-footer">
  <div class="container footer-inner">
    <div>
      @if (!empty($footer['logo']))
        <img src="{{ media_url($footer['logo']) }}" alt="" width="48" height="48" loading="lazy" />
      @endif
      <p>{{ $footer['text'] ?? '' }}</p>
    </div>
    <nav aria-label="Links do rodapé">
      @foreach ($footer['links'] ?? [] as $link)
        <a href="{{ $link['url'] ?? '#' }}">{{ $link['label'] ?? '' }}</a>
      @endforeach
    </nav>
    <div>
      @foreach ($footer['columns'] ?? [] as $line)
        <p>{{ is_array($line) ? ($line['text'] ?? '') : $line }}</p>
      @endforeach
    </div>
  </div>
  <div class="container copyright">
    <p>© <span id="year">{{ date('Y') }}</span> {{ $footer['copyright'] ?? setting('site_name', '') }}. Todos os direitos reservados.</p>
  </div>
</footer>

@if ($whats)
  <a class="whats-float" href="{{ wa_url($whats, $footer['whatsapp_text'] ?? '') }}" target="_blank" rel="noopener" aria-label="Falar no WhatsApp">
    <img src="{{ media_url($footer['whatsapp_icon'] ?? '') }}" alt="" width="34" height="34" />
  </a>
@endif
