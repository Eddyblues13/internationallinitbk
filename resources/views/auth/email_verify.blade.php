<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Email Verification Required">
    <link rel="shortcut icon" href="{{ asset('path/to/favicon.ico') }}" type="image/x-icon">
    <title>Email Verification | User</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dashlite.css?ver=2.4.0') }}">
    <link rel="stylesheet" href="{{ asset('admin/scss/sweetalert.css') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin/assets/css/theme.css?ver=2.4.0') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</head>

<body class="nk-body npc-crypto bg-white pg-auth">
    <div class="nk-app-root">
        <div class="justify-center card-header">
            <div class="nk-block nk-auth-body text-center">
                <center class="brand-logo pb-5">
                    <a href="" class="logo-link">
                        <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/img/logo1.png') }}"
                            alt="logo">
                    </a>
                </center>

                <div class="alert alert-warning">
                    <strong>Email Verification Required</strong>
                    <p>Please verify your email to continue.</p>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(session('success'))
                <script>
                    toastr.success("{{ session('success') }}");
                </script>
                @endif

                @if(session('error'))
                <script>
                    toastr.error("{{ session('error') }}");
                </script>
                @endif
                <form action="{{ route('verify.code') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">verification_code</label>
                            <a class="link link-primary link-sm" tabindex="-1" href="#">Need Help?</a>
                        </div>
                        <input type="number"
                            class="form-control form-control-lg @error('verification_code') is-invalid @enderror"
                            id="default-01" placeholder="Enter your verification code" name="verification_code"
                            value="{{ old('verification_code') }}">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div><!-- .form-group -->



                    <div class="form-group">
                        <button class="btn btn-lg btn-primary btn-block" type="submit" name="loginForm">Login</button>
                    </div>
                </form><!-- form -->
                <br />


                <a href="{{ route('resend.verification.code') }}" class="btn btn-lg btn-primary">Resend Verification
                    Email</a>

                <div class="nk-block nk-auth-footer mt-5">
                    <p>&copy; {{ date('Y') }}. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('admin/assets/js/bundle.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('admin/assets/js/scripts.js?ver=2.4.0') }}"></script>
    <script src="{{ asset('admin/assets/js/vendors/sweetalert.js') }}"></script>
</body>

</html>