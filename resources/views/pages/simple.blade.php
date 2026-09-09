@extends('layouts.site')

@section('content')
<main id="top" class="section" style="padding-top: 140px;">
  <div class="container narrow">
    <header class="section-head">
      <h1>{{ $page->title }}</h1>
    </header>
    <div class="split-text">
      {!! $page->body !!}
    </div>
  </div>
</main>
@endsection
