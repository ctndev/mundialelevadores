@php
  $privacyPage = \App\Models\Page::query()->published()->where('slug', 'politica-de-privacidade')->first();
@endphp

<div class="cookie-banner" id="cookie-banner" hidden role="dialog" aria-live="polite" aria-label="Aviso de cookies">
  <p>Usamos cookies para melhorar sua experiência no site. Ao continuar, você concorda com o uso.</p>
  <div class="cookie-banner-actions">
    @if ($privacyPage)
      <a href="{{ url('/politica-de-privacidade') }}">Política de privacidade</a>
    @endif
    <button type="button" class="btn btn-primary cookie-banner-accept" id="cookie-banner-accept">Entendi</button>
  </div>
</div>
