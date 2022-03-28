<nav class="main-header navbar navbar-expand navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{Auth::user()->avatar??asset('logo.jpeg')}}"
                     class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <li class="user-header bg-primary">
                    <img src="{{Auth::user()->avatar??asset('logo.jpeg')}}"
                         class="img-circle elevation-2"
                         alt="User Image">
                    <p>
                        {{ Auth::user()->name }}
                        <small>{{__('Member since')}} {{ Auth::user()->created_at->format('M. Y') }}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <a href="{{route('welcome')}}" class="btn btn-default btn-flat">{{__('Profile')}}</a>
                    <a href="#" class="btn btn-default btn-flat float-right"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{__('Sign out')}}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
