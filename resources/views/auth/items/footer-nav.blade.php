<div class="text-center mt-5 text-small">
    Copyright &copy; {{ date('Y') }} {{ app_settings()['site_title']->value }} - &#10100;code&#10101; with &hearts; by <a href="https://fpslogic.tech">@fpslogic</a>.
    <div class="mt-2">
        <a href="{{ route('docs', '1.x') }}" target="_blank">Dokumentasi</a>
        <div class="bullet"></div>
        <a href="{{ route('faqs') }}" target="_blank">Pertanyaan Umum</a>
        <div class="bullet"></div>
        <a href="{{ route('helps') }}" target="_blank">Pusat Bantuan</a>
    </div>
    <span class="badge badge-pill badge-light mt-3">v{{ config('app.version', '1') }}</span>
</div>