<div class="polyglot">
    <ul class="polyglot-list">
        @foreach (config('polyglot.languages') as $code => $name)
            @if (app()->getLocale() !== $code) {{-- Avoid displaying the current language in the list. --}}
                <li class="polyglot-item">
                    <a rel="alternate"
                       hreflang="{{ $code }}"
                       href="{{ Polyglot::switchTo($code) }}"
                       class="polyglot-link"
                    >
                        {{ $name }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
