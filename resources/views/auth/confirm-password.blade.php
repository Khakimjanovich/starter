<x-guest-layout>
    <div class="login-box">
        <x-auth.authentication-logo/>
        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <x-auth.input type="password" name="password" placeholder="Password" span="fas fa-eye-slash"/>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Confirm Password</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div>
</x-guest-layout>
