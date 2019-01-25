<div class="polyglot">
    <ul class="polyglot-list">
        @foreach (config('polyglot.languages') as $language)
            @if (app()->getLocale() !== $language) {{-- Avoid displaying the current language in the list. --}}
                <li class="polyglot-item">
                    <a rel="alternate"
                       hreflang="{{ $language }}"
                       href="{{ polyglot()->switchTo($language) }}"
                       class="polyglot-link"
                    >
                        @lang($language)
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
