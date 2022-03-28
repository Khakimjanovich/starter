<x-guest-layout>
    <div class="login-box">
        <x-auth.authentication-logo/>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">
                    You are only one step a way from your new password, recover your password now.
                </p>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @php
                        if (!isset($token)) {
                            $token = \Request::route('token');
                        }
                    @endphp
                    <input type="hidden" name="token" value="{{ $token }}">
                    <x-auth.input/>
                    <x-auth.input type="password" name="password"
                                  placeholder="Password" span="fas fa-eye-slash"/>
                    <x-auth.input type="password" name="password_confirmation"
                                  placeholder="Confirm Password" span="fas fa-eye-slash"/>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                        </div>
                    </div>
                </form>
                <p class="mt-3 mb-1">
                    <a href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
