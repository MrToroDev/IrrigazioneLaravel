<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>{{ config('app.name') }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset("css/home.style.css") }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-stem">
        <div class="container-fluid">
            <!-- Titolo -->
            <a class="navbar-brand navbar-brand-stem" href="#">
                <i class="fas fa-seedling"></i> {{ config('app.name') }}
            </a>

            <!-- Pulsante per mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarStem"
                aria-controls="navbarStem" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbarStem">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link nav-link-stem" href="{{ route('dashboard') }}">
                            <i class="fa-solid fa-chart-bar"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-stem" href="{{ route("logout") }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
                        </a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a class="nav-link nav-link-stem" href="{{ route("login") }}">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="stem-container">
        <div class="stem-card">

            <!-- Titolo principale -->
            <h1 class="stem-title">
                <i class="fas fa-seedling"></i> StemCity
            </h1>
            <div class="stem-sub">
                <i class="fas fa-tint"></i> standardization for urban gardens
            </div>

            <!-- Carosello di immagini su orti e serre -->
            <div id="stemCarousel" class="carousel slide carousel-fade carousel-wrapper" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#stemCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#stemCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#stemCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <!-- Immagine orto cittadino con irrigazione -->
                        <img src="https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?q=80&w=1470&auto=format&fit=crop"
                            class="d-block w-100" alt="Orto urbano rigoglioso - irrigazione a goccia">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><i class="fas fa-city me-1"></i> Connected local gardens</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <!-- Serra moderna con piante -->
                        <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?q=80&w=1470&auto=format&fit=crop"
                            class="d-block w-100" alt="Serra tecnologica con ortaggi">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><i class="fas fa-leaf me-1"></i> Intelligent greenhouses</h5>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <!-- Dettaglio irrigazione orto -->
                        <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?q=80&w=1470&auto=format&fit=crop"
                            class="d-block w-100" alt="Irrigazione sostenibile in campo">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><i class="fas fa-water me-1"></i> Sustainable standard</h5>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#stemCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#stemCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">next</span>
                </button>
            </div>

            <!-- Descrizione del progetto -->
            <div class="description-block">
                <p class="description-text">
                    <i class="fas fa-quote-left opacity-50 me-1"></i>
                    SteamCity is a in-development large project which puts as its objective the standardization
                    of gardens's irrigation, firstly in small cities and then, hopefully, nationally.
                    <i class="fas fa-quote-right opacity-50 ms-1"></i>
                </p>
                <div class="badge-container">
                    <span class="stem-badge"><i class="fas fa-map-marker-alt"></i> Local → Global</span>
                    <span class="stem-badge"><i class="fas fa-hand-holding-water"></i> Water saving</span>
                    <span class="stem-badge"><i class="fas fa-chart-line"></i> Open standard</span>
                </div>
            </div>

            <!-- Bottoni di invito / call to action leggeri -->
            <div class="d-flex justify-content-center flex-wrap gap-3 mt-2">
                <a href="#" class="btn btn-stem"><i class="fas fa-seedling"></i> Check the project</a>
                {{-- <a href="#" class="btn btn-outline-success rounded-pill px-4 py-2"><i class="far fa-compass me-1"></i>
                    Orti vicino a te</a> --}}
            </div>

            <div class="footer-note">
                <i class="far fa-clock"></i> Soon! · <span class="fw-bold">StemCity</span>
            </div>
            <hr>
            <p class="text-center text-muted small mb-0" style="opacity:0.8;">
                <i class="far fa-copyright"></i> 2026 StemCity — gardens and community united together
            </p>
        </div>
    </div>

    <!-- Bootstrap JS per carosello -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
</body>

</html>