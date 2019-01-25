@foreach (config('polyglot.languages') as $language)
    <link rel="alternate" hreflang="{{ $language }}" href="{{ polyglot()->switchTo($language) }}">
@endforeach
