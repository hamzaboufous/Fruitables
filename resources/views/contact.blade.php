@extends('layouts.app')

@section('content')
<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold">Contactez-Nous</h1>
            <p class="text-muted">Nous serions ravis d'avoir de vos nouvelles</p>
        </div>

        <div class="row g-4">
            <div class="col-lg-5">
                <div class="bg-light rounded p-4">
                    <h4 class="mb-4">Informations de Contact</h4>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle me-3">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Adresse</h6>
                            <p>6M Street, Guelmim, Maroc</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle me-3">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Téléphone</h6>
                            <p>+212 6 51 99 79 56</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle me-3">
                            <i class="fa fa-envelope text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Email</h6>
                            <p>admin@fruitables.com</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0 btn-square bg-secondary rounded-circle me-3">
                            <i class="fa fa-clock text-white"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Heures d'ouverture</h6>
                            <p>Lundi - Vendredi: 8h00 - 18h00</p>
                            <p>Samedi: 9h00 - 16h00</p>
                            <p>Dimanche: Fermé</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="bg-light rounded p-4">
                    <h4 class="mb-4">Envoyez-nous un message</h4>
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Votre Nom" value="{{ old('name') }}" required>
                                    <label for="name">Votre Nom</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Votre Email" value="{{ old('email') }}" required>
                                    <label for="email">Votre Email</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Sujet" value="{{ old('subject') }}" required>
                                    <label for="subject">Sujet</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Laissez un message ici" id="message" name="message" style="height: 150px" required>{{ old('message') }}</textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3" type="submit">Envoyer le Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
