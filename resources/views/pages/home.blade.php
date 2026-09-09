@extends('layouts.site')

@section('content')
@php
  $c = $page->content ?? [];
  $hero = $c['hero'] ?? [];
  $about = $c['about'] ?? [];
  $services = $c['services'] ?? [];
  $platforms = $c['platforms'] ?? [];
  $credit = $c['credit'] ?? [];
  $elevac = $c['elevac'] ?? [];
  $brands = $c['brands'] ?? [];
  $suppliers = $c['suppliers'] ?? [];
  $gallery = $c['gallery'] ?? [];
  $faq = $c['faq'] ?? [];
  $contact = $c['contact'] ?? [];
  $whats = $settings['whatsapp'] ?? '';
@endphp

<main id="top">
  @if ($hero['is_visible'] ?? true)
  <section class="hero">
    <div class="hero-media" aria-hidden="true">
      @foreach ($hero['slides'] ?? [] as $i => $slide)
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
  <section class="section" id="sobre">
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

  @if ($services['is_visible'] ?? true)
  <section class="section section-alt" id="servicos">
    <div class="container">
      <header class="section-head reveal">
        @if (!empty($services['eyebrow']))<p class="eyebrow">{{ $services['eyebrow'] }}</p>@endif
        @if (!empty($services['title']))<h2>{{ $services['title'] }}</h2>@endif
        @if (!empty($services['lead']))<p class="lead">{{ $services['lead'] }}</p>@endif
      </header>
      <div class="cards cards-3">
        @foreach ($services['cards'] ?? [] as $card)
          <article class="card card-photo reveal">
            @if (!empty($card['image']))
              <img src="{{ media_url($card['image']) }}" alt="{{ $card['image_alt'] ?? $card['title'] ?? '' }}" loading="lazy" />
            @endif
            <div class="card-body">
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['text'] ?? '' }}</p>
            </div>
          </article>
        @endforeach
      </div>
      <div class="cards cards-4 mini-cards">
        @foreach ($services['mini_cards'] ?? [] as $card)
          <div class="card card-mini reveal">
            <h3>{{ $card['title'] ?? '' }}</h3>
            <p>{{ $card['text'] ?? '' }}</p>
          </div>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if ($platforms['is_visible'] ?? true)
  <section class="section" id="plataformas">
    <div class="container">
      <header class="section-head reveal">
        @if (!empty($platforms['eyebrow']))<p class="eyebrow">{{ $platforms['eyebrow'] }}</p>@endif
        @if (!empty($platforms['title']))<h2>{{ $platforms['title'] }}</h2>@endif
        @if (!empty($platforms['lead']))
          <p class="lead">{!! $platforms['lead'] !!}</p>
        @endif
      </header>
      <div class="cards cards-3">
        @foreach ($platforms['cards'] ?? [] as $card)
          <article class="card card-photo reveal">
            @if (!empty($card['image']))
              <img src="{{ media_url($card['image']) }}" alt="{{ $card['image_alt'] ?? $card['title'] ?? '' }}" loading="lazy" />
            @endif
            <div class="card-body">
              <h3>{{ $card['title'] ?? '' }}</h3>
              <p>{{ $card['text'] ?? '' }}</p>
            </div>
          </article>
        @endforeach
      </div>
      @if (!empty($platforms['features']))
        <div class="feature-strip reveal">
          <ul>
            @foreach ($platforms['features'] as $feature)
              <li>{{ is_array($feature) ? ($feature['label'] ?? '') : $feature }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
  </section>
  @endif

  @if ($credit['is_visible'] ?? true)
  <section class="section" id="credito">
    <div class="container">
      <div class="split split-reverse reveal">
        <div class="split-media">
          @if (!empty($credit['image']))
            <img src="{{ media_url($credit['image']) }}" alt="{{ $credit['image_alt'] ?? '' }}" loading="lazy" />
          @endif
        </div>
        <div class="split-text">
          @if (!empty($credit['eyebrow']))<p class="eyebrow">{{ $credit['eyebrow'] }}</p>@endif
          @if (!empty($credit['title']))<h2>{{ $credit['title'] }}</h2>@endif
          @foreach ($credit['paragraphs'] ?? [] as $p)
            <p>{{ is_array($p) ? ($p['text'] ?? '') : $p }}</p>
          @endforeach
          @if (!empty($credit['cta_label']))
            <a class="btn btn-primary" href="{{ wa_url($whats, $credit['cta_text'] ?? '') }}" target="_blank" rel="noopener">{{ $credit['cta_label'] }}</a>
          @endif
        </div>
      </div>
    </div>
  </section>
  @endif

  @if ($elevac['is_visible'] ?? true)
  <section class="section section-dark" id="elevac">
    <div class="container split reveal">
      <div class="split-text">
        @if (!empty($elevac['eyebrow']))<p class="eyebrow">{{ $elevac['eyebrow'] }}</p>@endif
        @if (!empty($elevac['title']))<h2>{{ $elevac['title'] }}</h2>@endif
        @if (!empty($elevac['text']))<p>{{ $elevac['text'] }}</p>@endif
        @if (!empty($elevac['cta_label']))
          <a class="btn btn-primary" href="{{ $elevac['cta_url'] ?? '#elevac' }}">{{ $elevac['cta_label'] }}</a>
        @endif
      </div>
      <div class="split-media">
        @if (!empty($elevac['image']))
          <img src="{{ media_url($elevac['image']) }}" alt="{{ $elevac['image_alt'] ?? '' }}" loading="lazy" />
        @endif
      </div>
    </div>
  </section>
  @endif

  @if ($brands['is_visible'] ?? true)
  <section class="section" id="marcas">
    <div class="container">
      <header class="section-head reveal">
        @if (!empty($brands['eyebrow']))<p class="eyebrow">{{ $brands['eyebrow'] }}</p>@endif
        @if (!empty($brands['title']))<h2>{{ $brands['title'] }}</h2>@endif
        @if (!empty($brands['lead']))<p class="lead">{{ $brands['lead'] }}</p>@endif
      </header>
      <div class="brand-grid reveal">
        @foreach ($brands['items'] ?? [] as $item)
          <div class="brand-item"><span>{{ is_array($item) ? ($item['name'] ?? '') : $item }}</span></div>
        @endforeach
      </div>
      @if (!empty($brands['note']))
        <p class="note reveal">{{ $brands['note'] }}</p>
      @endif
    </div>
  </section>
  @endif

  @if ($suppliers['is_visible'] ?? true)
  <section class="section section-alt" id="fornecedores">
    <div class="container">
      <header class="section-head reveal">
        @if (!empty($suppliers['eyebrow']))<p class="eyebrow">{{ $suppliers['eyebrow'] }}</p>@endif
        @if (!empty($suppliers['title']))<h2>{{ $suppliers['title'] }}</h2>@endif
        @if (!empty($suppliers['lead']))<p class="lead">{{ $suppliers['lead'] }}</p>@endif
      </header>
      <div class="supplier-grid">
        @foreach ($suppliers['items'] ?? [] as $item)
          <article class="supplier {{ !empty($item['highlight']) ? 'supplier-highlight' : '' }} reveal">
            <h3>{{ $item['name'] ?? '' }}</h3>
            <p>{{ $item['text'] ?? '' }}</p>
          </article>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if ($gallery['is_visible'] ?? true)
  <section class="section" id="galeria">
    <div class="container">
      <header class="section-head reveal">
        @if (!empty($gallery['eyebrow']))<p class="eyebrow">{{ $gallery['eyebrow'] }}</p>@endif
        @if (!empty($gallery['title']))<h2>{{ $gallery['title'] }}</h2>@endif
      </header>
      <div class="gallery" id="gallery">
        @foreach ($gallery['items'] ?? [] as $item)
          <button class="gallery-item reveal" type="button">
            <img src="{{ media_url($item['image'] ?? '') }}" alt="{{ $item['alt'] ?? '' }}" loading="lazy" />
          </button>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if ($faq['is_visible'] ?? true)
  <section class="section section-alt" id="faq">
    <div class="container narrow">
      <header class="section-head reveal">
        @if (!empty($faq['eyebrow']))<p class="eyebrow">{{ $faq['eyebrow'] }}</p>@endif
        @if (!empty($faq['title']))<h2>{{ $faq['title'] }}</h2>@endif
      </header>
      <div class="faq" id="faq-list">
        @foreach ($faq['items'] ?? [] as $item)
          <details class="reveal">
            <summary>{{ $item['question'] ?? '' }}</summary>
            <p>{{ $item['answer'] ?? '' }}</p>
          </details>
        @endforeach
      </div>
    </div>
  </section>
  @endif

  @if ($contact['is_visible'] ?? true)
  <section class="section" id="contato">
    <div class="container split">
      <div class="split-text reveal">
        @if (!empty($contact['eyebrow']))<p class="eyebrow">{{ $contact['eyebrow'] }}</p>@endif
        @if (!empty($contact['title']))<h2>{{ $contact['title'] }}</h2>@endif
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
        @if (!empty($contact['map_embed']))
          <div class="map">
            <iframe title="{{ $contact['map_title'] ?? 'Mapa' }}" src="{{ $contact['map_embed'] }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        @endif
      </div>

      <div class="split-text reveal">
        <form class="form" id="contact-form" method="post" action="{{ route('contacts.store') }}" novalidate>
          <h3>{{ $contact['form_title'] ?? 'Solicite um orçamento ou vistoria' }}</h3>
          <label>
            Nome
            <input type="text" name="nome" required placeholder="Seu nome" />
          </label>
          <label>
            Telefone / WhatsApp
            <input type="tel" name="telefone" required placeholder="(85) 9....." />
          </label>
          <label>
            Mensagem <span class="form-optional">(opcional)</span>
            <textarea name="mensagem" rows="4" placeholder="Conte o que você precisa"></textarea>
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
