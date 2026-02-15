@extends('layouts.app')

@section('title', 'Mot de passe oublié')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="bg-light rounded p-4">
                    <div class="text-center mb-4">
                        <h3 class="mb-3">Mot de passe oublié</h3>
                        <p class="text-muted">Entrez votre adresse email pour recevoir un lien de réinitialisation</p>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   placeholder="Entrez votre adresse email"
                                   required
                                   autocomplete="email"
                                   autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary py-3">
                                Envoyer le lien de réinitialisation
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="text-decoration-none">
                            <i class="fas fa-arrow-left me-2"></i>Retour à la connexion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
