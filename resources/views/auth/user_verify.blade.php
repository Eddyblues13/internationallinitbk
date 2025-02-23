<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Account Verification Required">
    <link rel="shortcut icon" href="{{ asset('path/to/favicon.ico') }}" type="image/x-icon">
    <title>Account Verification | user</title>
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

                <div class="alert alert-warning">
                    <strong>Account Verification Required</strong>
                    <p>Your account is pending verification. Please contact support for assistance.</p>
                </div>
                <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <a href="/" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-lg btn-primary">Back to home Page</a>


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