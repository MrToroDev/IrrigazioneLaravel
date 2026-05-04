<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset("css/dashboard.style.css") }}" rel="stylesheet">
    
    @yield("header")

</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Menu -->
            <div class="col-md-3 col-lg-2 sidebar">
                <div class="profile-section text-center">
                    <i class="bi bi-person-circle" style="font-size: 3rem; color: rgba(30, 59, 47, 0.92);"></i>
                    <h6 class="mt-2 mb-0">{{ Auth::user()->getNome() . " " . Auth::user()->getCognome() }}</h6>
                    <small class="text-muted">{{ Auth::user()->getRuolo() }}</small>
                </div>
                
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.orto') ? 'active' : '' }}" href="{{ route('dashboard.orto') }}">
                            <i class="bi bi-house-door"></i> Gardens
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.sensori') ? 'active' : '' }}" href="{{ route('dashboard.sensori') }}">
                            <i class="bi bi-bar-chart"></i> Sensors
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.alert') ? 'active' : '' }}" href="{{ route('dashboard.alert') }}">
                            <i class="bi bi-envelope"></i> Alerts
                            @if (($numAlerts = Auth::user()->alerts()->whereNull("Visualizzato")->count()) > 0)
                                <span class="badge bg-danger float-end">{{ $numAlerts }}</span>
                            @endif
                        </a>
                    </li>
                    
                    <hr class="my-3">
                    
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('settings.index') ? 'active' : '' }}" href="{{ route('settings.index') }}">
                            <i class="bi bi-gear"></i> Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.help') ? 'active' : '' }}" href="{{ route('user.help') }}">
                            <i class="bi bi-question-circle"></i> Help
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="bi bi-arrow-90deg-down"></i> Back to Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="{{ route("logout") }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
            
            <!-- Area Contenuto Principale -->
            <div class="col-md-9 col-lg-10 content-area" id="content-area">
                @sectionMissing("content")
                <br>
                <div class="text-center">
                    <i class="bi bi-arrow-left-circle" style="font-size: 3rem; color: #dee2e6;"></i>
                    <p class="text-muted">
                        Click an option to view data!
                    </p>
                </div>
                
                @else
                
                @yield("content")
                
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS e Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    @yield("loadingFinished")
</body>
</html>