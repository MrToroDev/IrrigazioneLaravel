<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .card {
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label {
            color: var(--bs-primary);
            opacity: 0.8;
        }

        .form-control:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.25);
        }

        #togglePassword {
            color: var(--bs-gray-600);
            border: none;
            background: transparent;
            padding: 0.5rem;
        }

        #togglePassword:hover {
            color: var(--bs-primary);
        }

        #togglePassword:focus {
            box-shadow: none;
        }

        .btn-primary {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(var(--bs-primary-rgb), 0.3);
        }
    </style>
</head>

<body class="bg-light">
    <main>
        <div class="container">
            <div class="row justify-content-center min-vh-100 align-items-center">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card shadow-lg border-0 rounded-lg">
                        <div class="card-header bg-primary text-white text-center py-4 border-0 rounded-top">
                            <h3 class="mb-0 fw-bold">
                                <i class="fas fa-sign-in-alt me-2"></i>Accedi
                            </h3>
                            <p class="mb-0 mt-2 small opacity-75">Inserisci le tue credenziali per continuare</p>
                        </div>

                        <div class="card-body p-4 p-md-5">
                            {{-- Session Status --}}
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('status') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Errori di Validazione --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Attenzione!</strong> Verifica i dati inseriti.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login.verify') }}" class="needs-validation" novalidate>
                                @csrf

                                {{-- Campo Email --}}
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="nome@esempio.com"
                                        value="{{ old('email') }}" required autofocus autocomplete="email">
                                    <label for="email">
                                        <i class="fas fa-envelope me-2 text-muted"></i>Indirizzo Email
                                    </label>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-info-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Campo Password --}}
                                <div class="form-floating mb-4 position-relative">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password" required
                                        autocomplete="current-password">
                                    <label for="password">
                                        <i class="fas fa-lock me-2 text-muted"></i>Password
                                    </label>
                                    <button
                                        class="btn btn-link position-absolute end-0 top-50 translate-middle-y me-2 text-decoration-none"
                                        type="button" id="togglePassword" style="z-index: 10;">
                                        <i class="fas fa-eye" id="toggleIcon"></i>
                                    </button>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-info-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- Ricordami --}}
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label user-select-none" for="remember">
                                        <i class="fas fa-clock me-1"></i>Ricordami
                                    </label>
                                </div>

                                {{-- Pulsante Login --}}
                                <div class="d-grid gap-2 mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-sign-in-alt me-2"></i>Accedi
                                    </button>
                                </div>

                                {{-- Link Password Dimenticata --}}
                                @if (Route::has('password.request'))
                                    <div class="text-center">
                                        <a href="{{ route('password.request') }}" class="text-decoration-none">
                                            <i class="fas fa-key me-1"></i>Hai dimenticato la password?
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>

                        {{-- Footer Card --}}
                        @if (Route::has('register'))
                            <div class="card-footer bg-light text-center py-3 border-0 rounded-bottom">
                                <p class="mb-0 text-muted">
                                    Non hai un account?
                                    <a href="{{ route('register') }}" class="fw-bold text-decoration-none">
                                        <i class="fas fa-user-plus me-1"></i>Registrati
                                    </a>
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
    </main>

    {{-- Bootstrap 5 JS Bundle --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (togglePassword && passwordInput && toggleIcon) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    // Cambia l'icona
                    toggleIcon.classList.toggle('fa-eye');
                    toggleIcon.classList.toggle('fa-eye-slash');
                });
            }

            // Validazione lato client Bootstrap
            const forms = document.querySelectorAll('.needs-validation');

            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        });
    </script>
</body>

</html>
