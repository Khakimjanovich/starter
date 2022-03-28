<x-guest-layout>
    <div class="register-box">
        <x-auth.authentication-logo/>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form method="post" action="{{ route('register') }}">
                    @csrf

                    <x-auth.input type="text" name="name"
                             placeholder="Full name" span="fas fa-user"/>
                    <x-auth.input/>
                    <x-auth.input type="password" name="password"
                             placeholder="Password" span="fas fa-eye-slash"/>
                    <x-auth.input type="password" name="password_confirmation"
                             placeholder="Retype password" span="fas fa-eye-slash"/>

                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="{{route('privacy-policy')}}">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->

        <!-- /.form-box -->
    </div>
</x-guest-layout>
