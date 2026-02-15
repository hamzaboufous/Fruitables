@extends('layouts.app')

@push('styles')
<style>
:root {
    --primary-green: #28a745;
    --primary-green-dark: #218838;
    --primary-green-light: #e8f5e9;
    --text-primary: #2c3e50;
    --text-muted: #6c757d;
}

.register-container {
    min-height: 100vh;
    display: flex;
    flex-direction: row;
    overflow: hidden;
    background: white;
}

/* Colonne gauche - Formulaire */
.register-left {
    width: 50%;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px;
}

.register-card {
    width: 100%;
    max-width: 500px;
    padding: 40px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    border-radius: 16px;
}

.register-header {
    text-align: center;
    margin-bottom: 40px;
}

.register-header .logo {
    color: var(--primary-green);
    font-size: 2.2rem;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 30px;
    transition: transform 0.3s ease;
}

.register-header .logo:hover {
    transform: scale(1.05);
}

.register-header h3 {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.register-header p {
    color: var(--text-muted);
    font-size: 0.95rem;
}

.input-group {
    margin-bottom: 25px;
    position: relative;
}

.input-group-text {
    background: var(--primary-green-light);
    border: 1px solid var(--primary-green-light);
    border-right: none;
    border-radius: 12px 0 0 12px;
    color: var(--primary-green);
    width: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.1rem;
}

.form-control {
    border-radius: 0 12px 12px 0;
    border: 1px solid var(--primary-green-light);
    border-left: none;
    padding: 16px 18px;
    font-size: 16px;
    transition: all 0.3s ease;
    height: 56px;
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

.password-toggle {
    border-left: none !important;
    border-radius: 0 12px 12px 0 !important;
    cursor: pointer;
    background: var(--primary-green-light) !important;
    border: 1px solid var(--primary-green-light) !important;
    color: var(--primary-green) !important;
    width: 55px;
}

.password-toggle:hover {
    background: var(--primary-green) !important;
    color: white !important;
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary-green) 0%, #20c997 100%);
    border: none;
    border-radius: 12px;
    padding: 16px;
    font-weight: 600;
    transition: all 0.3s ease;
    height: 56px;
    font-size: 16px;
    letter-spacing: 0.5px;
    box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
}

.login-link {
    text-align: center;
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #e9ecef;
    font-size: 15px;
    color: var(--text-muted);
}

.text-primary {
    color: var(--primary-green) !important;
    text-decoration: none;
    font-weight: 500;
}

.text-primary:hover {
    color: var(--primary-green-dark) !important;
    text-decoration: underline;
}

.alert {
    border-radius: 12px;
    margin-bottom: 25px;
    border: none;
    padding: 18px 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
}

/* Colonne droite - Illustration */
.register-right {
    width: 50%;
    background: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px;
}

.register-illustration {
    max-width: 900px;
    width: 100%;
    height: auto;
    animation: float 3s ease-in-out infinite;
    margin-bottom: 0;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

.register-welcome {
    text-align: center;
    margin-top: 40px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 0 20px;
}

.register-welcome h2 {
    color: var(--primary-green);
    font-weight: 700;
    font-size: 2.8rem;
    margin-bottom: 15px;
    animation: fadeInUp 0.8s ease;
    line-height: 1.2;
    max-width: 100%;
    text-align: center;
}

.register-welcome p {
    color: var(--text-primary);
    font-size: 1.3rem;
    font-weight: 400;
    animation: fadeInUp 1s ease;
    margin: 0;
    line-height: 1.4;
    max-width: 100%;
    text-align: center;
}

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

@media (max-width: 991.98px) {
    .register-container {
        flex-direction: column;
    }
    
    .register-right {
        display: none;
    }
    
    .register-left {
        width: 100%;
        min-height: 100vh;
    }
    
    .register-card {
        padding: 30px 25px;
    }
}

@media (max-width: 576px) {
    .register-left {
        padding: 20px;
    }
    
    .register-card {
        padding: 25px 20px;
    }
    
    .register-header h3 {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="register-container">
    <!-- Colonne gauche - Formulaire -->
    <div class="register-left">
        <div class="register-card">
            <div class="register-header">
                <a href="{{ route('home') }}" class="logo">
                    <h3><i class="fas fa-shopping-basket me-2"></i>Fruitables</h3>
                </a>
                <h3>Inscription</h3>
                <p>Créez votre compte en quelques secondes</p>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Veuillez corriger les erreurs ci-dessous
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('first_name') is-invalid @enderror" 
                                   name="first_name" 
                                   placeholder="Prénom" 
                                   value="{{ old('first_name') }}" 
                                   required>
                        </div>
                        @error('first_name')
                            <div class="invalid-feedback d-block mt-1 mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('last_name') is-invalid @enderror" 
                                   name="last_name" 
                                   placeholder="Nom" 
                                   value="{{ old('last_name') }}" 
                                   required>
                        </div>
                        @error('last_name')
                            <div class="invalid-feedback d-block mt-1 mb-3">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           name="email" 
                           placeholder="Adresse email" 
                           value="{{ old('email') }}" 
                           required>
                </div>
                @error('email')
                    <div class="invalid-feedback d-block mt-1 mb-3">
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
                           required>
                    <span class="input-group-text password-toggle" type="button" onclick="togglePassword('password', 'togglePassword1')">
                        <i class="fas fa-eye" id="togglePassword1"></i>
                    </span>
                </div>
                @error('password')
                    <div class="invalid-feedback d-block mt-1 mb-3">
                        {{ $message }}
                    </div>
                @enderror

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" 
                           class="form-control" 
                           id="password_confirmation"
                           name="password_confirmation" 
                           placeholder="Confirmer le mot de passe" 
                           required>
                    <span class="input-group-text password-toggle" type="button" onclick="togglePassword('password_confirmation', 'togglePassword2')">
                        <i class="fas fa-eye" id="togglePassword2"></i>
                    </span>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-4">
                    <i class="fas fa-user-plus me-2"></i>
                    S'inscrire
                </button>
            </form>
            
            <div class="login-link">
                Déjà un compte ? 
                <a href="{{ route('login') }}" class="text-primary">
                    <i class="fas fa-sign-in-alt me-1"></i>
                    Se connecter
                </a>
            </div>
        </div>
    </div>

    <!-- Colonne droite - Illustration -->
    <div class="register-right d-none d-lg-flex">
        <div class="register-illustration">
            <img src="{{ asset('assets/img/login-illustration 2.png') }}" 
                 alt="Register Illustration" 
                 class="img-fluid">
        </div>
        <div class="register-welcome">
            <h2>Rejoignez Fruitables</h2>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Inscription en cours...';
        });
    }
});
</script>
@endsection