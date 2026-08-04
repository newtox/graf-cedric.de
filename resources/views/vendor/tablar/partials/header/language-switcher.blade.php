@php
    $currentLocale = app()->getLocale();
    $targetLocale = $currentLocale === 'de' ? 'en' : 'de';
@endphp

<a href="{{ route('language.switch', $targetLocale) }}" class="nav-link px-0" title="{{ __('menu.switch') }}"
   data-bs-toggle="tooltip"
   data-bs-placement="bottom">
    <i class="ti ti-language me-1"></i>
</a>