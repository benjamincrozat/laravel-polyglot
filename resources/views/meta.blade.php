@foreach (config('polyglot.languages') as $language)
    <link rel="alternate" href="{{ polyglot()->switchTo($language) }}">
@endforeach
