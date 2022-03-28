<x-guest-layout>
    <div class="register-box">
        <x-auth.authentication-logo/>
    @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg text-justify">
                    {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>
                <div class="row">
                    <div class="col-8">
                        <form method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-primary btn-block">{{ __('Resend Verification Email') }}</button>
                        </form>
                    </div>

                    <div class="col-4">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-block">{{ __('Log Out') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
