<x-app-layout>
    <x-slot name="header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{\Illuminate\Support\Str::ucfirst('dashboard')}}</h1>
                </div>
                <x-breadcrumb/>
            </div>
        </div>
    </x-slot>
    <section class="content">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{'Update a user'}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <form action="{{ route('users.update',$user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{__('Name')}}</label>
                                <input type="text" name="name"
                                       class="form-control {{ $errors->has('name') ? "is-invalid":"" }}"
                                       value="{{ old('name',$user->name) }}" required>
                                @if($errors->has('name'))
                                    <span class="error invalid-feedback">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{__('Email')}}</label>
                                <input type="email" name="email"
                                       class="form-control {{ $errors->has('email') ? "is-invalid":"" }}"
                                       value="{{ old('email',$user->email) }}"
                                       required>
                                @if($errors->has('email'))
                                    <span class="error invalid-feedback">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label>{{__('Roles')}}</label>
                                <select class="select2" multiple="multiple" name="roles[]"
                                        data-placeholder="@lang('pleaseSelect')" style="width: 100%;">
                                    @foreach($roles as $role)
                                        <option
                                            value="{{ $role->name }}" {{ ($user->hasRole($role->name) ? "selected":'') }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('roles'))
                                    <span class="error invalid-feedback">{{ $errors->first('roles') }}</span>
                                @endif
                            </div>
                            <label>{{__('A new password')}}</label>
                            <div class="form-group" id="show_hide_password">
                                <div class="input-group mb-3" id="showHidePasswordOne">
                                    <input type="password" name="password" id="new-password"
                                           class="form-control {{ $errors->has('password') ? "is-invalid":"" }}">
                                    <div class="input-group-append">
                                        <span toggle="#password-field" class="input-group-text"><i
                                                class="fa fa-fw fa-eye-slash "></i></span>
                                    </div>
                                    @if($errors->has('password'))
                                        <span class="error invalid-feedback">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$user->id}}">
                            <label>{{__('Password confirmation')}}</label>
                            <div class="form-group">
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
                                <button type="submit" class="btn btn-success float-right">{{__('Save')}}</button>
                                <a href="{{ route('users.index') }}"
                                   class="btn btn-default float-left">{{__('Cancel')}}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
@push('scripts')
    <script>
        $(function () {

            $(document).ready(function () {
                $("#showHidePasswordOne span").on('click', function (event) {
                    event.preventDefault();
                    if ($('#showHidePasswordOne input').attr("type") === "text") {
                        $('#showHidePasswordOne input').attr('type', 'password');
                        $('#showHidePasswordOne i').addClass("fa-eye-slash");
                        $('#showHidePasswordOne i').removeClass("fa-eye");
                    } else if ($('#showHidePasswordOne input').attr("type") === "password") {
                        $('#showHidePasswordOne input').attr('type', 'text');
                        $('#showHidePasswordOne i').removeClass("fa-eye-slash");
                        $('#showHidePasswordOne i').addClass("fa-eye");
                    }
                });
            });
            $(document).ready(function () {
                $("#showHidePasswordTwo span").on('click', function (event) {
                    event.preventDefault();
                    if ($('#showHidePasswordTwo input').attr("type") === "text") {
                        $('#showHidePasswordTwo input').attr('type', 'password');
                        $('#showHidePasswordTwo i').addClass("fa-eye-slash");
                        $('#showHidePasswordTwo i').removeClass("fa-eye");
                    } else if ($('#showHidePasswordTwo input').attr("type") === "password") {
                        $('#showHidePasswordTwo input').attr('type', 'text');
                        $('#showHidePasswordTwo i').removeClass("fa-eye-slash");
                        $('#showHidePasswordTwo i').addClass("fa-eye");
                    }
                });
            });
        })
    </script>
@endpush

