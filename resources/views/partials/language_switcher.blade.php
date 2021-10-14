{{-- <a class="text-white fw-bold" href="">
    <img src="{{ asset('assets/img/algeria-flag-icon-32.png') }}" alt="Ar">
</a> --}}
@if ($current_locale == 'fr')
    <a class="text-white fw-bold" href="language/ar">
        <img src="{{ asset('assets/img/ar-flag-icon-32.png') }}" alt="Ar">
    </a>
@elseif ($current_locale == 'ar')
    <a class="text-white fw-bold" href="language/fr">
        <img src="{{ asset('assets/img/fr-flag-icon-32.png') }}" alt="Ar">
    </a>
@endif
