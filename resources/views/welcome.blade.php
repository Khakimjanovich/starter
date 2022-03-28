<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script defer src="{{asset('js/script.js')}}"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3711774989030278"
            crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name')}}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" rel="stylesheet">
    <style>
        .correct {
            color: green;
        }

        .incorrect {
            color: red;
            text-decoration: underline;
        }

        .no-select {
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -moz-user-select: none; /* Old versions of Firefox */
            -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
        }
    </style>

</head>
<body>
<div class="container-fluid fixed-top p-4">
    <div class="col-12">
        <div class="d-flex justify-content-end">
            @if (Route::has('login'))
                <div class="">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-muted">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-muted">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ms-4 text-muted">Register</a>
                        @endif
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
<div class="container-fluid my-5 pt-5 px-5">
    <div class="row justify-content-center px-4">
        <div class="col-md-12 col-lg-9">
            <div class="card shadow-sm p-4">
                <table class="table ">
                    <thead>
                    <tr>
                        <th scope="col">
                            <h1 class="no-select" id="word"></h1>
                        </th>
                        <th scope="col">
                            <p id="timer"></p>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">
                            <input aria-describedby="basic-addon1"
                                   aria-label="Shu yerga yuqoridagi so`zni kiritasiz"
                                   class="form-control "
                                   id="input"
                                   type="text"
                            >
                        </th>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
