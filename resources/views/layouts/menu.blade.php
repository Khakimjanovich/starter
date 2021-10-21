<li class="nav-item">
    <a href="{{ route('dashboard') }}" class="nav-link @if(Route::is('dashboard')){{' active'}} @endif">
        <i class="nav-icon fas fa-tachometer-alt"></i>
        <p>{{__('Dashboard')}}</p>
    </a>
</li>
<li class="nav-item @if(Route::is('users.*')||Route::is('roles.*')||Route::is('permissions.*')){{'menu-open'}}@endif">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-user"></i>
        <p>
            {{__('Management')}}
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link @if(Route::is('users.*')){{' active'}}@endif">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Users')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('roles.index')}}" class="nav-link @if(Route::is('roles.*')){{' active'}}@endif">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Roles')}}</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('permissions.index')}}" class="nav-link @if(Route::is('permissions.*')){{' active'}}@endif">
                <i class="far fa-circle nav-icon"></i>
                <p>{{__('Permissions')}}</p>
            </a>
        </li>
    </ul>
</li>
