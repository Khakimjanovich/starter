@can('browse-dashboard')
    <li class="nav-item">
        <a href="{{ route('dashboard') }}" class="nav-link @if(Route::is('dashboard')){{' active'}} @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>{{__('Dashboard')}}</p>
        </a>
    </li>
@endcan
@can('browse-profile')
    <li class="nav-item @if(Route::is('profile.*')){{'menu-open'}}@endif">
        <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-user"></i>
            <p>
                {{__('Profile')}}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('browse-me')
                <li class="nav-item">
                    <a href="{{route('profile.me')}}" class="nav-link @if(Route::is('profile.me')){{' active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('Me')}}</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
@can('browse-management')
    <li class="nav-item @if(Route::is('users.*')||Route::is('roles.*')||Route::is('permissions.*')){{'menu-open'}}@endif">
        <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-adjust"></i>
            <p>
                {{__('Management')}}
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            @can('browse-users')
                <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link @if(Route::is('users.*')){{' active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('Users')}}</p>
                    </a>
                </li>
            @endcan
            @can('browse-roles')
                <li class="nav-item">
                    <a href="{{route('roles.index')}}" class="nav-link @if(Route::is('roles.*')){{' active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('Roles')}}</p>
                    </a>
                </li>
            @endcan
            @can('browse-permissions')
                <li class="nav-item">
                    <a href="{{route('permissions.index')}}" class="nav-link @if(Route::is('permissions.*')){{' active'}}@endif">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('Permissions')}}</p>
                    </a>
                </li>
            @endcan
        </ul>
    </li>
@endcan
