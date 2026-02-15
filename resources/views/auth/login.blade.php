@extends('layouts.app')

@push('styles')
<style>
:root {
    /* Vert principal */
    --primary-green: #28a745;
    --primary-green-dark: #218838;
    --primary-green-light: #e8f5e9;
    --primary-green-lighter: #c8e6c9;
    
    /* Background gauche */
    --left-bg: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
    
    /* Card formulaire */
    --card-bg: #ffffff;
    --card-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    
    /* Texte */
    --text-primary: #2c3e50;
    --text-muted: #6c757d;
}

/* Container principal */
.login-container {
    min-height: 100vh;
    display: flex;
    flex-direction: row;
    overflow: hidden;
}

/* Colonne gauche - Illustration */
.login-left {
    width: 60%;
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px;
    position: relative;
}

.login-left::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.1;
}

.login-illustration {
    max-width: 650px;
    width: 100%;
    height: auto;
    z-index: 1;
    position: relative;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.login-welcome {
    text-align: center;
    margin-top: 40px;
    z-index: 1;
    position: relative;
}

.login-welcome h2 {
    color: var(--primary-green);
    font-weight: 700;
    font-size: 3rem;
    margin-bottom: 20px;
    animation: fadeInUp 0.8s ease;
}

.login-welcome p {
    color: var(--text-primary);
    font-size: 1.2rem;
    font-weight: 400;
    opacity: 0.8;
    animation: fadeInUp 1s ease;
}

/* Colonne droite - Formulaire */
.login-right {
    width: 40%;
    background: white; /* أبيض solid */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
    box-shadow: -10px 0 30px rgba(0, 0, 0, 0.1); /* ظل على الجانب */
}

.login-card {
    width: 100%;
    max-width: 450px;
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: -15px 0 40px rgba(0, 0, 0, 0.15); /* ظل أكبر */
    padding: 40px;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.login-header {
    text-align: center;
    margin-bottom: 35px;
}

.login-header .logo {
    color: var(--primary-green);
    font-size: 2rem;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 25px;
    transition: transform 0.3s ease;
}

.login-header .logo:hover {
    transform: scale(1.05);
}

.login-header h3 {
    color: var(--text-primary);
    font-weight: 600;
    margin-bottom: 10px;
    font-size: 1.8rem;
}

.login-header p {
    color: var(--text-muted);
    font-size: 0.95rem;
    margin: 0;
}

/* Formulaire */
.input-group {
    margin-bottom: 20px;
    position: relative;
}

.input-group-text {
    background: var(--primary-green-light);
    border: 1px solid var(--primary-green-light);
    border-right: none;
    border-radius: 10px 0 0 10px;
    color: var(--primary-green);
    width: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.form-control {
    border-radius: 0 10px 10px 0;
    border: 1px solid var(--primary-green-light);
    border-left: none;
    padding: 14px 16px;
    font-size: 16px;
    transition: all 0.3s ease;
    height: 52px;
    background: #fafafa;
}

.form-control:focus {
    border-color: var(--primary-green);
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
    background: white;
}

.input-group:focus-within .input-group-text {
    border-color: var(--primary-green);
    background: var(--primary-green);
    color: white;
}

/* Password toggle */
.password-toggle {
    border-left: none !important;
    border-radius: 0 10px 10px 0 !important;
    cursor: pointer;
    background: var(--primary-green-light) !important;
    border: 1px solid var(--primary-green-light) !important;
    color: var(--primary-green) !important;
}

.password-toggle:hover {
    background: var(--primary-green) !important;
    color: white !important;
}

/* Bouton */
.btn-primary {
    background: var(--primary-green);
    border: none;
    border-radius: 10px;
    padding: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    height: 52px;
    font-size: 16px;
    letter-spacing: 0.5px;
}

.btn-primary:hover {
    background: var(--primary-green-dark);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
}

/* Checkbox */
.form-check {
    margin-bottom: 20px;
}

.form-check-input:checked {
    background-color: var(--primary-green);
    border-color: var(--primary-green);
}

.form-check-label {
    color: var(--text-primary);
    font-size: 0.95rem;
}

/* Liens */
.text-primary {
    color: var(--primary-green) !important;
    text-decoration: none;
    font-weight: 500;
}

.text-primary:hover {
    color: var(--primary-green-dark) !important;
    text-decoration: underline;
}

.forgot-password {
    text-align: right;
    margin-bottom: 25px;
}

.forgot-password a {
    font-size: 14px;
}

.register-link {
    text-align: center;
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #e9ecef;
    font-size: 14px;
    color: var(--text-muted);
}

.register-link a {
    font-weight: 600;
}

/* Alertes */
.alert {
    border-radius: 10px;
    margin-bottom: 25px;
    border: none;
    padding: 15px 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Responsive */
@media (max-width: 991.98px) {
    .login-container {
        flex-direction: column;
    }
    
    .login-left {
        display: none;
    }
    
    .login-right {
        width: 100%;
        padding: 20px;
        min-height: 100vh;
    }
    
    .login-card {
        padding: 30px 25px;
        max-width: 100%;
    }
    
    .login-header h3 {
        font-size: 1.5rem;
    }
    
    .login-welcome h2 {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .login-right {
        padding: 15px;
    }
    
    .login-card {
        padding: 25px 20px;
        border-radius: 12px;
    }
    
    .login-header h3 {
        font-size: 1.3rem;
    }
    
    .btn-primary {
        height: 48px;
        font-size: 15px;
    }
    
    .form-control {
        height: 48px;
        padding: 12px 14px;
    }
}

/* Smooth transitions */
* {
    transition: all 0.3s ease;
}

/* Focus states */
.form-control:focus,
.btn-primary:focus {
    outline: none;
    transform: scale(1.02);
}

/* Loading state */
.btn-primary:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}
</style>
@endpush

@section('content')
<div class="login-container">
    <!-- Colonne gauche - Illustration -->
    <div class="login-left d-none d-lg-flex">
        <div class="login-illustration">
            <img src="{{ asset('assets/img/login-illustration1.png') }}" 
                 alt="Shopping Illustration" 
                 class="img-fluid"
                 style="max-width: 100%; height: auto;">
        </div>
        <div class="login-welcome">
            <h2>Bienvenue sur Fruitables</h2>
            
        </div>
    </div>
    
    <!-- Colonne droite - Formulaire -->
    <div class="login-right">
        <div class="login-card">
            <div class="login-header">
                <a href="{{ route('home') }}" class="logo">
                    <h3><i class="fas fa-shopping-basket me-2"></i>Fruitables</h3>
                </a>
                <h3>Connexion</h3>
                <p>Accédez à votre espace personnel</p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Veuillez corriger les erreurs ci-dessous
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           placeholder="Adresse email" 
                           value="{{ old('email') }}" 
                           required
                           autocomplete="email">
                </div>
                @error('email')
                    <div class="invalid-feedback d-block mt-1">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        {{ $message }}
                    </div>
                @enderror

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Mot de passe" 
                           required
                           autocomplete="current-password">
                    <span class="input-group-text password-toggle" type="button">
                        <i class="fas fa-eye" id="togglePassword"></i>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block mt-1">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        {{ $message }}
                    </div>
                @enderror

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    <div class="forgot-password">
                        <a href="{{ route('password.request') }}" class="text-primary">Mot de passe oublié ?</a>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-sign-in-alt me-2"></i>
                    Se connecter
                </button>
            </form>
            
            <div class="register-link">
                Pas encore de compte ? 
                <a href="{{ route('register') }}" class="text-primary">
                    <i class="fas fa-user-plus me-1"></i>
                    S'inscrire
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            if (type === 'text') {
                this.classList.remove('fa-eye');
                this.classList.add('fa-eye-slash');
            } else {
                this.classList.remove('fa-eye-slash');
                this.classList.add('fa-eye');
            }
        });
    }
    
    // Remove placeholder on focus for all inputs
    const inputs = document.querySelectorAll('input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.setAttribute('data-placeholder', this.getAttribute('placeholder'));
            this.removeAttribute('placeholder');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value && this.getAttribute('data-placeholder')) {
                this.setAttribute('placeholder', this.getAttribute('data-placeholder'));
            }
        });
    });
    
    // Form submission loading state
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Connexion en cours...';
        });
    }
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert.classList.contains('show')) {
                alert.classList.remove('show');
                setTimeout(() => alert.remove(), 300);
            }
        }, 5000);
    });
});
</script>
@endsection