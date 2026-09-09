@extends('layouts.site')

@php
  $c = $page->content ?? [];
  $hero = $c['hero'] ?? [];
  $about = $c['about'] ?? [];
  $advantages = $c['advantages'] ?? [];
  $gallery = $c['gallery'] ?? [];
  $contact = $c['contact'] ?? [];
  $product = $c['product'] ?? [];
  $whats = $settings['whatsapp'] ?? '';
  $heroSlides = array_values(array_filter($hero['slides'] ?? [], fn ($slide) => ! empty($slide['image'])));
  $heroImage = $hero['image'] ?? ($heroSlides[0]['image'] ?? null);
  $aboutId = $about['id'] ?? 'sobre';
  $selectName = $contact['select_name'] ?? 'assunto';
@endphp

@section('content')
<main id="top">
  @if ($hero['is_visible'] ?? true)
  <section class="hero {{ $heroSlides === [] ? 'hero-single' : '' }}">
    <div
      class="hero-media"
      aria-hidden="true"
      @if ($heroSlides === [] && $heroImage)
        style="background-image: url('{{ media_url($heroImage) }}');"
      @endif
    >
      @foreach ($heroSlides as $i => $slide)
        <div class="hero-slide {{ $i === 0 ? 'is-active' : '' }}" style="background-image: url('{{ media_url($slide['image'] ?? '') }}');"></div>
      @endforeach
    </div>
    <div class="container hero-content">
      @if (!empty($hero['eyebrow']))<p class="eyebrow">{{ $hero['eyebrow'] }}</p>@endif
      @if (!empty($hero['title']))<h1>{{ $hero['title'] }}</h1>@endif
      @if (!empty($hero['text']))<p class="hero-text">{{ $hero['text'] }}</p>@endif
      <div class="hero-actions">
        @if (!empty($hero['primary_cta_label']))
          <a class="btn btn-primary" href="{{ str_starts_with($hero['primary_cta_url'] ?? '', 'http') ? $hero['primary_cta_url'] : wa_url($whats, $hero['primary_cta_text'] ?? '') }}" target="_blank" rel="noopener">{{ $hero['primary_cta_label'] }}</a>
        @endif
        @if (!empty($hero['secondary_cta_label']))
          <a class="btn btn-ghost" href="{{ $hero['secondary_cta_url'] ?? '#contato' }}">{{ $hero['secondary_cta_label'] }}</a>
        @endif
      </div>
      @if (!empty($hero['badges']))
        <ul class="hero-badges">
          @foreach ($hero['badges'] as $badge)
            <li>{{ is_array($badge) ? ($badge['label'] ?? '') : $badge }}</li>
          @endforeach
        </ul>
      @endif
    </div>
  </section>
  @endif

  @if ($about['is_visible'] ?? true)
  <section class="section" id="{{ $aboutId }}">
    <div class="container split reveal">
      <div class="split-media">
        @if (!empty($about['image']))
          <img src="{{ media_url($about['image']) }}" alt="{{ $about['image_alt'] ?? '' }}" loading="lazy" />
        @endif
      </div>
      <div class="split-text">
        @if (!empty($about['eyebrow']))<p class="eyebrow">{{ $about['eyebrow'] }}</p>@endif
        @if (!empty($about['title']))<h2>{{ $about['title'] }}</h2>@endif
        @foreach ($about['paragraphs'] ?? [] as $p)
          <p>{{ is_array($p) ? ($p['text'] ?? '') : $p }}</p>
        @endforeach
        @if (!empty($about['stats']))
          <div class="stats">
            @foreach ($about['stats'] as $stat)
              <div><strong>{{ $stat['value'] ?? '' }}</strong><span>{{ $stat['label'] ?? '' }}</span></div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </section>
  @endif

  @if (($advantages['is_visible'] ?? true) && !empty($advantages['cards']))
    <section class="section section-alt" id="vantagens">
      <div class="container">
        <header class="section-head reveal">
          @if (!empty($advantages['eyebrow']))<p class="eyebrow">{{ $advantages['eyebrow'] }}</p>@endif
          @if (!empty($advantages['title']))<h2>{{ $advantages['title'] }}</h2>@endif
          @if (!empty($advantages['lead']))<p class="lead">{{ $advantages['lead'] }}</p>@endif
        </header>
        <div class="cards cards-3">
          @foreach ($advantages['cards'] as $card)
            <div class="card card-mini reveal">
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['text'] ?? '' }}</p>
            </div>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  @if (($gallery['is_visible'] ?? true) && !empty($gallery['items']))
    <section class="section" id="galeria">
      <div class="container">
        <header class="section-head reveal">
          @if (!empty($gallery['eyebrow']))<p class="eyebrow">{{ $gallery['eyebrow'] }}</p>@endif
          @if (!empty($gallery['title']))<h2>{{ $gallery['title'] }}</h2>@endif
          @if (!empty($gallery['lead']))<p class="lead">{{ $gallery['lead'] }}</p>@endif
        </header>
        <div class="gallery">
          @foreach ($gallery['items'] as $item)
            <button class="gallery-item reveal" type="button">
              <img src="{{ media_url($item['image'] ?? '') }}" alt="{{ $item['alt'] ?? '' }}" loading="lazy" />
            </button>
          @endforeach
        </div>
      </div>
    </section>
  @endif

  @if ($contact['is_visible'] ?? true)
    <section class="section section-dark" id="contato">
    <div class="container split">
      <div class="split-text reveal">
        @if (!empty($contact['eyebrow']))<p class="eyebrow">{{ $contact['eyebrow'] }}</p>@endif
        @if (!empty($contact['title']))<h2>{{ $contact['title'] }}</h2>@endif
        @if (!empty($contact['text']))<p>{{ $contact['text'] }}</p>@endif
        <ul class="contact-list">
          @if (!empty($contact['address']))
            <li>
              <strong>Endereço</strong>
              {!! nl2br(e($contact['address'])) !!}
            </li>
          @endif
          @if (!empty($contact['email'] ?? $settings['email'] ?? null))
            <li>
              <strong>E-mail</strong>
              <a href="mailto:{{ $contact['email'] ?? $settings['email'] }}">{{ $contact['email'] ?? $settings['email'] }}</a>
            </li>
          @endif
          @if (!empty($contact['phones']))
            <li>
              <strong>Telefones</strong>
              @foreach ($contact['phones'] as $i => $phone)
                @if ($i > 0)<br />@endif
                <a href="tel:{{ $phone['tel'] ?? '' }}">{{ $phone['display'] ?? $phone['tel'] ?? '' }}</a>
              @endforeach
            </li>
          @endif
        </ul>
      </div>
      <div class="split-text reveal">
        <form class="form" id="contact-form" data-product="{{ $contact['form_product'] ?? $page->title }}" novalidate>
          <h3>{{ $contact['form_title'] ?? 'Solicite um orçamento' }}</h3>
          <label>
            Nome
            <input type="text" name="nome" required placeholder="Seu nome" />
          </label>
          <label>
            Telefone / WhatsApp
            <input type="tel" name="telefone" required placeholder="(85) 9....." />
          </label>
          @if (!empty($contact['subjects']))
            <label>
              {{ $contact['select_label'] ?? 'Assunto' }}
              <select name="{{ $selectName }}">
                @foreach ($contact['subjects'] as $subject)
                  <option>{{ is_array($subject) ? ($subject['label'] ?? '') : $subject }}</option>
                @endforeach
              </select>
            </label>
          @endif
          <label>
            Mensagem
            <textarea name="mensagem" rows="4" placeholder="Conte sobre o seu imóvel"></textarea>
          </label>
          <button class="btn btn-primary" type="submit">{{ $contact['form_button'] ?? 'Enviar pelo WhatsApp' }}</button>
          <p class="form-note">{{ $contact['form_note'] ?? '' }}</p>
        </form>
      </div>
    </div>
    </section>
  @endif
</main>
@endsection

@if (!empty($product['name']))
  @push('head')
    <script type="application/ld+json">
      {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product['name'],
        'description' => $product['description'] ?? $page->seoDescription(),
        'image' => ! empty($product['image']) ? media_url($product['image']) : null,
        'brand' => ['@type' => 'Brand', 'name' => $product['brand'] ?? $page->title],
        'seller' => [
          '@type' => 'LocalBusiness',
          'name' => $settings['site_name'] ?? $page->title,
          'telephone' => array_values(array_filter(array_map(fn ($p) => $p['tel'] ?? null, $contact['phones'] ?? []))),
          'email' => $contact['email'] ?? ($settings['email'] ?? null),
          'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $settings['address'] ?? null,
            'postalCode' => $settings['postal_code'] ?? null,
            'addressLocality' => $settings['city'] ?? 'Fortaleza',
            'addressRegion' => $settings['region'] ?? 'CE',
            'addressCountry' => 'BR',
          ],
          'areaServed' => $settings['area_served'] ?? 'Ceará',
        ],
      ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
  @endpush
@endif
