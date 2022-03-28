@props([
'route' => 'dashboard',
'active' => 'dashboard',
'name' => 'Dashboard',
'icon' => 'fas fa-tachometer-alt'
])

<li class="nav-item">
    <a href="{{ route($route) }}" class="nav-link @if(Route::is($active)){{' active'}} @endif">
        <i class="nav-icon {{$icon}}"></i>
        <p>{{__($name)}}</p>
    </a>
</li>
