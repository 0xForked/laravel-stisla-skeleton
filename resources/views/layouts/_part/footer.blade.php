<footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; {{ date('Y') }} {{ app_settings()['site_title']->value }} - &#10100;code&#10101; with &hearts; by <a href="https://fpslogic.tech">@fpslogic</a> with latest's <a href="https://fpslogic.tech/sitsa#tech-stack">Tech Stack</a>.
    </div>
    <div class="footer-right">
        <span class="badge badge-pill badge-light">v{{ config('app.version', '1') }}</span>
    </div>
</footer>
