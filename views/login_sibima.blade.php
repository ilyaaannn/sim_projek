<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($isRegister) && $isRegister ? 'Register' : 'Login' }} - SIBIMA+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: #ffffff;
            min-height: 100vh;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        /* Left Side - Hero Section */
        .hero-section {
            background: linear-gradient(135deg, #f5f5f5 0%, #e5e5e5 100%);
            width: 50%;
            position: relative;
            overflow: hidden;
            padding: 3rem;
        }

        .hero-logo {
            position: absolute;
            top: 2rem;
            left: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .hero-logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #ff6b35 0%, #dc2626 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
        }

        .hero-logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
        }

        .hero-content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            padding: 2rem;
        }

        .umkm-title {
            font-size: 4rem;
            font-weight: 700;
            color: #ff6b35;
            letter-spacing: 0.1em;
            margin-bottom: 2rem;
        }

        .hero-visual {
            position: relative;
            width: 280px;
            height: 280px;
            background: white;
            border-radius: 2rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .hero-visual i {
            font-size: 8rem;
            color: #ff6b35;
        }

        .floating-icon {
            position: absolute;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            animation: float 3s ease-in-out infinite;
        }

        .floating-icon-1 {
            top: -1rem;
            left: -1rem;
            width: 64px;
            height: 64px;
            background: #e9d5ff;
        }

        .floating-icon-2 {
            top: 2rem;
            right: -1rem;
            width: 80px;
            height: 80px;
            background: #fef3c7;
        }

        .floating-icon-3 {
            bottom: -1rem;
            left: 3rem;
            width: 96px;
            height: 96px;
            background: #e5e7eb;
        }

        .floating-icon-4 {
            bottom: 2rem;
            right: -2rem;
            width: 112px;
            height: 112px;
            background: #d1d5db;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .hero-tagline {
            background: linear-gradient(135deg, #374151 0%, #1f2937 100%);
            color: white;
            padding: 1.5rem 2rem;
            border-radius: 1rem;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .hero-tagline p {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            line-height: 1.6;
        }

        .hero-footer {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            max-width: 400px;
        }

        .hero-footer-logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .hero-footer-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #ff6b35 0%, #dc2626 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
        }

        .hero-footer-text {
            font-size: 0.875rem;
            color: #374151;
            line-height: 1.6;
        }

        /* Right Side - Auth Form */
        .auth-section {
            width: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-container {
            width: 100%;
            max-width: 480px;
        }

        .auth-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .auth-icon {
            width: 80px;
            height: 80px;
            background: #dbeafe;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .auth-icon i {
            font-size: 2.5rem;
            color: #2563eb;
        }

        .auth-title {
            font-size: 2rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .auth-subtitle {
            color: #6b7280;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 600;
            color: #374151;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
        }

        .form-control:focus,
        .form-select:focus {
            background: white;
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        .input-icon {
            position: relative;
        }

        .input-icon i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
        }

        .input-icon .form-control {
            padding-left: 2.75rem;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 0;
        }

        .password-toggle:hover {
            color: #6b7280;
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff6b35 0%, #dc2626 100%);
            border: none;
            padding: 0.875rem;
            font-weight: 600;
            border-radius: 0.5rem;
            box-shadow: 0 4px 14px rgba(255, 107, 53, 0.4);
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ff7b45 0%, #ef4444 100%);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.5);
            transform: translateY(-2px);
        }

        .forgot-password {
            color: #ff6b35;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .forgot-password:hover {
            color: #dc2626;
        }

        .auth-switch {
            text-align: center;
            margin-top: 1.5rem;
            color: #6b7280;
        }

        .auth-switch a {
            color: #ff6b35;
            text-decoration: none;
            font-weight: 600;
            margin-left: 0.5rem;
        }

        .auth-switch a:hover {
            color: #dc2626;
        }

        .alert {
            border-radius: 0.5rem;
            border: none;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .hero-section {
                display: none;
            }

            .auth-section {
                width: 100%;
            }

            .mobile-logo {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                margin-bottom: 2rem;
            }

            .mobile-logo-icon {
                width: 48px;
                height: 48px;
                background: linear-gradient(135deg, #ff6b35 0%, #dc2626 100%);
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 24px;
            }
        }

        @media (min-width: 992px) {
            .mobile-logo {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="main-container">
        <!-- Left Side - Hero Section -->
        <div class="hero-section d-none d-lg-block">
            <!-- Logo -->
            <div class="hero-logo">
                <div class="hero-logo-icon">
                    <i class="bi bi-shop"></i>
                </div>
                <span class="hero-logo-text">SIBIMA+</span>
            </div>

            <!-- Main Content -->
            <div class="hero-content">
                <h1 class="umkm-title">UMKM</h1>

                <div class="hero-visual">
                    <i class="bi bi-shop"></i>

                    <!-- Floating Icons -->
                    <div class="floating-icon floating-icon-1">🔔</div>
                    <div class="floating-icon floating-icon-2">💰</div>
                    <div class="floating-icon floating-icon-3">📍</div>
                    <div class="floating-icon floating-icon-4">🛒</div>
                </div>

                <div class="hero-tagline">
                    <p>"Atur bisnis Anda dengan lebih mudah, cepat, dan terorganisir."</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="hero-footer">
                <div class="hero-footer-logo">
                    <div class="hero-footer-logo-icon">
                        <i class="bi bi-shop"></i>
                    </div>
                    <span style="font-size: 1.25rem; font-weight: 700; color: #1f2937;">SIBIMA+</span>
                </div>
                <p class="hero-footer-text">
                    Membantu UMKM Mengelola Penjualan, Stok, Dan Pembelian Dalam Satu Sistem Yang Modern Dan Efisien.
                </p>
            </div>
        </div>

        <!-- Right Side - Auth Form -->
        <div class="auth-section">
            <div class="auth-container">
                <!-- Mobile Logo -->
                <div class="mobile-logo">
                    <div class="mobile-logo-icon">
                        <i class="bi bi-shop"></i>
                    </div>
                    <span style="font-size: 1.5rem; font-weight: 700; color: #1f2937;">SIBIMA+</span>
                </div>

                <!-- Auth Header -->
                <div class="auth-header">
                    <div class="auth-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    <h2 class="auth-title">{{ isset($isRegister) && $isRegister ? 'Register' : 'Login' }}</h2>
                    <p class="auth-subtitle">
                        {{ isset($isRegister) && $isRegister ? 'Buat akun SIBIMA+ baru' : 'Masuk ke akun SIBIMA+ Anda' }}
                    </p>
                </div>

                <!-- Alerts -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif

                <!-- Auth Form -->
                @if(isset($isRegister) && $isRegister)
                <!-- REGISTER FORM -->
                <form action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}"
                            placeholder="Masukkan nama lengkap" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-icon">
                            <i class="bi bi-envelope"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}"
                                placeholder="email@example.com" required>
                        </div>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">No Handphone</label>
                        <div class="input-icon">
                            <i class="bi bi-phone"></i>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                name="phone" value="{{ old('phone') }}"
                                placeholder="08xxxxxxxxxx" required>
                        </div>
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <div class="input-icon">
                            <i class="bi bi-geo-alt"></i>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                name="alamat" rows="2"
                                placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                        </div>
                        @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select class="form-select @error('level') is-invalid @enderror" name="level" required>
                            <option value="">Pilih Level</option>
                            <option value="kostumer" {{ old('level') == 'kostumer' ? 'selected' : '' }}>Kostumer</option>
                        </select>
                        @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-icon">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password"
                                placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <i class="bi bi-eye" id="password-icon"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <div class="input-icon">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control"
                                id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <i class="bi bi-eye" id="password_confirmation-icon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus me-2"></i>REGISTER
                        </button>
                    </div>
                </form>

                <div class="auth-switch">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </div>
                @else
                <!-- LOGIN FORM -->
                <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email or username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}"
                            placeholder="Email or username" required>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-icon">
                            <i class="bi bi-lock"></i>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="login-password" name="password"
                                placeholder="Masukkan password" required>
                            <button type="button" class="password-toggle" onclick="togglePassword('login-password')">
                                <i class="bi bi-eye" id="login-password-icon"></i>
                            </button>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="text-end mb-4">
                        <a href="#" class="forgot-password">Forgot password?</a>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>LOGIN
                        </button>
                    </div>
                </form>

                <div class="auth-switch">
                    Don't have an account yet?
                    <a href="{{ route('register') }}">Sign UP</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');

            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>

</html>
