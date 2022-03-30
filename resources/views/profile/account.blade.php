<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{\Illuminate\Support\Str::ucfirst('dashboard')}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">{{\Illuminate\Support\Str::upper('dashboard')}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{Auth::user()->avatar??asset('logo.jpeg')}}"
                                 alt="{{Auth::user()->name}}">
                        </div>
                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                        <p class="text-muted text-center">{{Auth::user()->roles->first()->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings"
                                                    data-toggle="tab">Settings</a></li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" action="{{ route('account.update',Auth::user()->id) }}"
                                      method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class=" form-group">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" name="name"
                                               class="form-control {{ $errors->has('name') ? "is-invalid":"" }}"
                                               value="{{ old('name',Auth::user()->name) }}"
                                               required>
                                        @if($errors->has('name'))
                                            <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Email')}}</label>
                                        <input type="email" name="email"
                                               class="form-control {{ $errors->has('email') ? "is-invalid":"" }}"
                                               value="{{ old('email',Auth::user()->email) }}"
                                               required>
                                        @if($errors->has('email'))
                                            <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group" id="show_hide_password">
                                        <label>{{__('A new password')}}</label>
                                        <div class="input-group mb-3" id="showHidePasswordOne">
                                            <input type="password" name="password" id="new-password"
                                                   class="form-control {{ $errors->has('password') ? "is-invalid":"" }}">
                                            <div class="input-group-append">
                                                <span toggle="#password-field" class="input-group-text"><i
                                                        class="fa fa-fw fa-eye-slash "></i></span>
                                            </div>
                                            @if($errors->has('password'))
                                                <span
                                                    class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                    <div class="form-group">
                                        <label>{{__('Password confirmation')}}</label>
                                        <div class="input-group mb-3" id="showHidePasswordTwo">
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" autocomplete="new-password">
                                            <div class="input-group-append">
                                                <span toggle="#password-confirm" class="input-group-text"><i
                                                        class="fa fa-fw fa-eye-slash"></i></span>
                                            </div>
                                            @if($errors->has('password_confirmation'))
                                                <span
                                                    class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit"
                                                class="btn btn-success float-right">{{__('Save')}}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    @foreach($timeline as $date => $actions)
                                        <div class="time-label">
                                            <span class="bg-danger">{{$date}}</span>
                                        </div>
                                        @php(usort($actions,fn ($a,$b) => $b['action_hour'] <=> $a['action_hour']))
                                        @foreach($actions as $action)
                                            <div>
                                                <i class="fas @if($action['action_type'] === 'Logs'){{'fa fa-anchor bg-success'}}@else{{'fa-envelope bg-primary'}}@endif "></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> {{$action['action_hour']}}</span>
                                                    <div class="timeline-body">
                                                        @if($action['action_type'] === 'Logs')
                                                            You have visited: {{ $action['route']}}
                                                            Count: {{$action['count']}}
                                                        @else
                                                            Your subscription history:
                                                            <span class="alert-primary">Name</span>: {{$action['name']}}
                                                            <span class="alert-success">Status</span>: {{$action['status']}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endforeach
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
