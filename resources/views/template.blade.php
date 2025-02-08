<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $menu.' - Monitoring Jumlah Penduduk' }}</title>
    <!-- Scripts -->
    <link href="{{ asset('library/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css?time='.time()) }}">
</head>

<body>
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#"><b>Monitoring Penduduk Indonesia</b></a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Monitoring Penduduk Indonesia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 {{ $menu == 'Master Provinsi' ? 'active' : '' }}" href="{{ route('province') }}">Master Provinsi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx-lg-2 {{ $menu == 'Master Kabupaten' ? 'active' : '' }}" href="{{ route('regency') }}">Master Kabupaten</a>
                        </li>
                    </ul>
                </div>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    {{-- section --}}
    <section class="main-section">
        @yield('section')
    </section>

    {{-- footer --}}
    <footer class="py-2">
        <div class="container-fluid">
            © 2025 <b>JMC Task 1</b> | by : Aldi Pradana
        </div>
    </footer>
</body>

</html>
