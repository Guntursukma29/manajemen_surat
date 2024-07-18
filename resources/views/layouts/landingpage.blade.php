<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" sizes="76x76" href="{{ asset('../assets') }}/img/logo-almaata.png">
    <link rel="icon" type="image/png" href="{{ asset('../assets') }}/img/logo-almaata.png">
    <title>
        Selamat Datang
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('../assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('../assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('../assets') }}/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="bg-gray-200">

    <main class="main-content mt-0">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('request_surat.index') }}">Pengajuan Surat</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section>
            <div class="page-header min-vh-100 ">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('assets') }}/img/logo-almaata.png" style="width: 300px"
                                alt="{{ asset('assets') }}/img/logo-almaata.png">
                            <br>
                            <h2 class="text-center">Selamat Datang Di Website Manajemen Surat Universitas Alma Ata</h2>
                        </div>
                        <div class="col-md-6 p-3">
                            <div class="card p-3">
                                <div class="card-header">
                                    <h4 class="font-weight-bolder text-center" id="form-title">Login</h4>
                                    <p class="mb-0">Enter your email and password to Login</p>
                                </div>
                                <div class="card-body">
                                    <div id="login-form">
                                        <form role="form" method="POST" action="{{ route('login') }}">
                                            @csrf
                                            <div class="input-group input-group-dynamic mb-3">
                                                <label for="email"
                                                    class="form-label">{{ __('Email Address') }}</label>
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="email" autofocus>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="input-group input-group-dynamic mb-3">
                                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="form-check form-switch d-flex align-items-center mb-3">
                                                <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                                                <label class="form-check-label mb-0 ms-3"
                                                    for="rememberMe">{{ __('Remember Me') }}</label>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                    class="btn bg-gradient-primary w-100 my-4 mb-2">{{ __('Login') }}</button>

                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center"></div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('../assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('../assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('../assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('../assets') }}/js/plugins/smooth-scrollbar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>
