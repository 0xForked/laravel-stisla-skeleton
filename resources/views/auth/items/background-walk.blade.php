<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('assets/img/sites/' . background_walk()) }}">
    <div class="absolute-bottom-left index-2">
        <div class="text-light p-5 pb-2">
            <div class="mb-5 pb-3">
                <h1 class="mb-2 display-4 font-weight-bold">{{ current_greeting() }}</h1>
                <h5 class="font-weight-normal text-muted-transparent">Manado, Indonesia</h5>
            </div>
            @if (Carbon\Carbon::now()->format('H') > 17)
                Photo by <a class="text-light bb" target="_blank" href="https://manadokota.go.id/">Pemerintah Kota Manado</a> on <a class="text-light bb" target="_blank" href="https://s.id/g-manado">Manado</a>
            @else
                Photo by <a class="text-light bb" target="_blank" href="https://www.instagram.com/grandwar/">Grand Prang</a> on <a class="text-light bb" target="_blank" href="https://s.id/g-manado">Manado</a>
            @endif
        </div>
    </div>
</div>