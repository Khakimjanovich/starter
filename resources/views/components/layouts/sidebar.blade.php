<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('welcome') }}" class="brand-link">
        <img src="{{asset('logo.jpeg')}}"
             alt="{{config('app.name')}}"
             class="brand-image img-circle elevation-3">
        <span class="brand-text">{{ \Illuminate\Support\Str::upper(config('app.name')) }}</span>
    </a>
    <x-layouts.sidebar-menu/>
</aside>
