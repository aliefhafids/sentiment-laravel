<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Signin</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="css/assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

    </style>


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <main class="form-signin mt-5 mb-5">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <h1 class="h2 mb-5 fw-bold text-center">{{ __('Login') }}</h1>
                 @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="floatingInput">{{ __('Email address') }}</label>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-floating">
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                        id="floatingPassword" name="password" required autocomplete="current-password">
                    <label for="floatingPassword">{{ __('Password') }}</label>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Keep me logged in') }}
                    </label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">{{ __('Sign in') }}</button>
            </form>
        </main>
    </div>
</body>

</html>
