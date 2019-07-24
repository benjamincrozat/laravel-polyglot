@foreach (config('polyglot.languages') ?? ['en' => 'English'] as $code => $name)
    <link rel="alternate" hreflang="{{ $code }}" href="{{ polyglot()->switchTo($code) }}">
@endforeach
