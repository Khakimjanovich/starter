<div class="sidebar">
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <x-layouts.sidebar-list/>

            @canany(['users.index','roles.index','permissions.index','devices.index'])
                <li class="nav-item @if(Route::is('users.*')||Route::is('roles.*')||Route::is('permissions.*')||Route::is('devices.*')){{'menu-open active'}}@endif">
                    <a href="#"
                       class="nav-link @if(Route::is('users.*')||Route::is('roles.*')||Route::is('permissions.*')||Route::is('devices.*')){{'active'}}@endif">
                        <i class="nav-icon fas fa-adjust"></i>
                        <p>
                            {{__('Management')}}
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('devices.index')
                            <x-layouts.sidebar-list name="Logs" route="devices.index"
                                                    active="devices.*" icon="far fa-circle"/>
                        @endcan
                        @can('users.index')
                            <x-layouts.sidebar-list name="Users" route="users.index"
                                                    active="users.*" icon="far fa-circle"/>
                        @endcan
                        @can('roles.index')
                            <x-layouts.sidebar-list name="Roles" route="roles.index"
                                                    active="roles.*" icon="far fa-circle"/>
                        @endcan
                        @can('permissions.index')
                            <x-layouts.sidebar-list name="Permissions" route="permissions.index"
                                                    active="permissions.*" icon="far fa-circle"/>
                        @endcan
                    </ul>
                </li>
            @endcan
            <li class="nav-item @if(Route::is('account*')||Route::is('actions*')){{'menu-open active'}}@endif">
                <a href="#"
                   class="nav-link @if(Route::is('account*')||Route::is('actions*')){{'active'}}@endif">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        {{__('Profile')}}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <x-layouts.sidebar-list name="Account" route="account"
                                            active="account*" icon="far fa-circle"/>
                </ul>
            </li>
        </ul>
    </nav>
</div>
