@extends("user.dashboard")
@use(App\Models\Utente)

@section("header")

<!-- Font Awesome 6 (free icons) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Google Fonts: Inter for modern look -->
<link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">

<link href="{{ asset('css/settings.css') }}" rel="stylesheet">
<script src="{{ asset('js/settings.js') }}"></script>

@endsection

@section("content")

<div class="container mt-4">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9 col-xl-8 col-md-10">
        
        <!-- main settings card -->
        <div class="card settings-card">
            <div class="card-header-custom">
            <h2><i class="fas fa-sliders-h me-2" style="color: rgba(30, 59, 47, 0.92);;"></i> Account settings</h2>
            <p>Manage your profile, contact details, and preferences</p>
            </div>
            
            <div class="settings-body">
            <form id="accountSettingsForm" method="post" action="{{ route('settings.update') }}">
                @csrf
                @method('PUT')

                <!-- FULL NAME -->
                <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label"><i class="fas fa-at me-1"></i> Name</label>
                    <input type="text" class="form-control" id="name" name="Nome" placeholder="Your name is important!" value="{{ Auth::user()->getNome() }}" required>
                </div>
                <div class="col-md-6">
                    <label for="surname" class="form-label"><i class="fas fa-at me-1"></i> Surname</label>
                    <input type="text" class="form-control" id="surname" name="Cognome" placeholder="Your surname is also important!" value="{{ Auth::user()->getCognome() }}" required>
                </div>
                </div>

                <br>

                <!-- EMAIL & PASSWORD -->
                <div class="row g-3">
                <div class="col-md-6">
                    <label for="email" class="form-label"><i class="fas fa-envelope me-1"></i> Email address</label>
                    <input type="email" class="form-control" id="email" name="Email" placeholder="Gotta say your email mate!" value="{{ Auth::user()->getEmail() }}" required>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label"><i class="fas fa-solid fa-key me-1"></i> Password</label>
                    <input type="password" class="form-control" id="password" name="Pword" placeholder="Wanna change password? Then write it!">
                </div>
                </div>

                <div class="divider-light"></div>

                <!-- Advanced account preferences (Soon! maybe) -->
                {{-- <h5 class="fw-semibold mb-3" style="font-size:1.1rem;"><i class="fas fa-bell me-2 text-secondary"></i>Notifications & visibility</h5>
                <div class="mb-3">
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                    <label class="form-check-label fw-medium" for="emailNotifications">Email notifications</label>
                    <div class="form-text">Receive account activity, security alerts and product updates.</div>
                </div>
                <div class="form-check form-switch mb-2">
                    <input class="form-check-input" type="checkbox" id="smsAlerts">
                    <label class="form-check-label fw-medium" for="smsAlerts">SMS alerts (2FA & login reminders)</label>
                    <div class="form-text">We’ll send critical alerts to your phone number.</div>
                </div>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="publicProfile" checked>
                    <label class="form-check-label fw-medium" for="publicProfile">Public profile visibility</label>
                    <div class="form-text">Allow others to see your profile and activity summary.</div>
                </div>
                </div> 

                <div class="divider-light"></div> --}}

                <!-- Security & language section (Soon! maybe) -->
                {{-- <div class="row g-3">
                <div class="col-md-6">
                    <label for="language" class="form-label"><i class="fas fa-language me-1"></i> Language</label>
                    <select class="form-select" id="language">
                    <option value="en" selected>English (US)</option>
                    <option value="es">Español</option>
                    <option value="fr">Français</option>
                    <option value="de">Deutsch</option>
                    <option value="ja">日本語</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-shield-alt me-1"></i> Two-factor authentication</label>
                    <div class="d-flex align-items-center justify-content-between border rounded-4 p-3 bg-light">
                    <div class="small fw-semibold">Status: <span id="twoFactorStatus" class="text-danger">Disabled</span></div>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" id="toggle2faBtn"><i class="fas fa-lock"></i> Enable</button>
                    </div>
                    <div class="form-text mt-1">Secure your account with an extra layer of protection.</div>
                </div>
                </div>

                <div class="divider-light"></div> --}}

                <!-- Danger zone (compact) -->
                <div class="alert alert-light border rounded-4 p-3 mt-2" style="background:#fef9f0;">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div>
                    <i class="fas fa-trash-alt text-danger me-2"></i>
                    <span class="fw-semibold">Delete account</span>
                    <div class="small text-muted">Once deleted, all data is permanently removed.</div>
                    </div>
                    <button type="button" id="deleteBtn" class="btn btn-sm btn-outline-danger rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                    <i class="fas fa-exclamation-triangle"></i> Delete
                    </button>
                </div>
                </div>

                <!-- action buttons -->
                <div class="d-flex flex-wrap justify-content-end gap-3 mt-4 pt-2">
                <button type="submit" class="btn btn-save text-white"><i class="fas fa-save me-1"></i>Save changes</button>
                </div>
            </form>
            </div>
        </div>
        <p class="text-center text-muted small mt-4"><i class="fas fa-shield-alt"></i> Your privacy is protected. Changes are securely saved.</p>
        </div>
    </div>
    </div>

    <!-- DELETE ACCOUNT CONFIRMATION MODAL -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
        <div class="modal-header border-0 pb-0">
            <h5 class="modal-title fw-bold" id="deleteModalLabel"><i class="fas fa-trash-alt text-danger me-2"></i>Permanently delete account?</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pt-2">
            <p>This action <strong>cannot be undone</strong>. All your profile data, settings, and personal information will be erased immediately.</p>
            <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="confirmDeleteCheck">
            <label class="form-check-label" for="confirmDeleteCheck">I understand the consequences, and I want to delete my account.</label>
            </div>
        </div>
        <div class="modal-footer border-0">
            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
            <form method="post" action="{{ route('settings.delete') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger rounded-pill px-4" id="confirmDeleteBtn" disabled>Delete permanently</button>
            </form>
        </div>
        </div>
    </div>
    </div>

    <!-- dynamic toast notification (feedback) -->
    <div class="alert-toast-fixed" id="liveToastMsg" style="display: none;">
    <div class="toast align-items-center text-white bg-dark border-0 rounded-4 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true">
        <div class="d-flex">
        <div class="toast-body" id="toastBodyMsg">
            <i class="fas fa-check-circle me-2"></i> Settings updated!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    </div>

</div>

@endsection

@section("loadingFinished")

@if (session('success') == true)
<script type="text/javascript">
    showToast("Account settings saved successfully! ✅", false);
</script>
@endif

@endsection