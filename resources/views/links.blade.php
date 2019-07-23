@foreach (config('polyglot.languages') as $code => $name)
    <link rel="alternate" hreflang="{{ $code }}" href="{{ polyglot()->switchTo($code) }}">
@endforeach
