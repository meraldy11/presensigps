<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>E-Presensi</title>
    <meta name="description" content="Mobilekit HTML Mobile UI Kit">
    <meta name="keywords" content="bootstrap 4, mobile template, cordova, phonegap, mobile, html" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/icon/192x192.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="manifest" href="__manifest.json">
</head>

<body class="" style="background-color: #120C37">

    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->


    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">

        <div class="login-form mt-1">
            <div class="section mt-5" >
                <img src="{{asset('assets/img/login.png')}}" alt="image" class="form-image">
            </div>
            <div class="section mt-4" >
                <h1 style="color: white">Selamat Datang</h1>
            </div>
            <div class="section mt-1 mb-1">
                @php
                    $messagewarning = Session::get('warning');
                @endphp
                @if (Session::get('warning'))
                <div class="alert alert-danger">
                    {{$messagewarning}}
                </div>
                @endif
                <form action="/proseslogin" method="POST">
                    @csrf
                    <div class="form-group boxed mt-3 mb-1">
                        <div class="input-wrapper">
                            <input type="text" name="nik" class="form-control" id="nik" placeholder="NIK">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div>

                    {{-- <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <i class="clear-input">
                                <ion-icon name="close-circle"></ion-icon>
                            </i>
                        </div>
                    </div> --}}
                    <div class="form-group boxed">
                        <div class="input-wrapper">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            <i class="toggle-password" onclick="togglePasswordVisibility()">
                                <ion-icon name="eye"></ion-icon>
                            </i>
                        </div>
                    </div>



                    <div class="form-links mt-2" style="margin-left: 65%">
                        <div><a href="page-forgot-password.html" class="text-light" >Forgot Password?</a></div>
                    </div>

                    <div class="form-button-group " style="background-color: #120C37">
                        <button type="submit" class="btn  btn-block btn-lg, text-dark" style="background-color: #EDC700">Login</button>
                    </div>

                </form>
            </div>
        </div>


    </div>
    <!-- * App Capsule -->



    <!-- ///////////// Js Files ////////////////////  -->
    <!-- Jquery -->
    <script src="{{ asset('assets/js/lib/jquery-3.4.1.min.js') }}"></script>
    <!-- Bootstrap-->
    <script src="{{ asset('assets/js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/lib/bootstrap.min.js') }}"></script>
    <!-- Ionicons -->
    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <!-- Owl Carousel -->
    <script src="{{ asset('assets/js/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
    <!-- jQuery Circle Progress -->
    <script src="{{ asset('assets/js/plugins/jquery-circle-progress/circle-progress.min.js') }}"></script>
    <!-- Base Js File -->
    <script src="{{ asset('assets/js/base.js') }}"></script>

    <style>
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 25px;
        }
    </style>


    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("password");
            var passwordToggle = document.querySelector(".toggle-password");

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordToggle.innerHTML = '<ion-icon name="eye"></ion-icon>';
            } else {
                passwordInput.type = "password";
                passwordToggle.innerHTML = '<ion-icon name="eye-off"></ion-icon>';
            }
        }
    </script>




</body>

</html>
