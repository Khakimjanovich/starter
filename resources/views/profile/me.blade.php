@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                 src="{{Auth::user()->avatar}}"
                                 alt="{{Auth::user()->name}}">
                        </div>
                        <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>
                        <p class="text-muted text-center">{{Auth::user()->roles->first()->name}}</p>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" action="{{ route('profile.update',Auth::user()->id) }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <div class=" form-group">
                                        <label>{{__('Name')}}</label>
                                        <input type="text" name="name" class="form-control {{ $errors->has('name') ? "is-invalid":"" }}"
                                               value="{{ old('name',Auth::user()->name) }}"
                                               required>
                                        @if($errors->has('name'))
                                            <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>{{__('Email')}}</label>
                                        <input type="email" name="email" class="form-control {{ $errors->has('email') ? "is-invalid":"" }}"
                                               value="{{ old('email',Auth::user()->email) }}"
                                               required>
                                        @if($errors->has('email'))
                                            <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group" id="show_hide_password">
                                        <label>{{__('A new password')}}</label>
                                        <div class="input-group mb-3" id="showHidePasswordOne">
                                            <input type="password" name="password" id="new-password" class="form-control {{ $errors->has('password') ? "is-invalid":"" }}">
                                            <div class="input-group-append">
                                                <span toggle="#password-field" class="input-group-text"><i class="fa fa-fw fa-eye-slash "></i></span>
                                            </div>
                                            @if($errors->has('password'))
                                                <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                    <div class="form-group">
                                        <label>{{__('Password confirmation')}}</label>
                                        <div class="input-group mb-3" id="showHidePasswordTwo">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                                            <div class="input-group-append">
                                                <span toggle="#password-confirm" class="input-group-text"><i class="fa fa-fw fa-eye-slash"></i></span>
                                            </div>
                                            @if($errors->has('password_confirmation'))
                                                <span class="error invalid-feedback">{{ $errors->first('password_confirmation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success float-right">{{__('Save')}}</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>

@endsection
