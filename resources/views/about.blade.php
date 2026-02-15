@extends('layouts.app')

@section('title', 'À Propos - Fruitables')

@section('content')
<!-- About Page Start -->
<div class="container-fluid about-page py-5">
    <div class="container py-5">
        <!-- Header Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary mb-3">À Propos de Fruitables</h1>
            <p class="lead text-muted">Votre partenaire de confiance pour des produits frais, bio et de qualité</p>
        </div>

        <!-- Main Content -->
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="about-content">
                    <!-- Introduction -->
                    <div class="intro-section mb-5">
                        <p class="fs-5 text-center mb-4">
                            Bienvenue chez <strong>Fruitables</strong>, votre destination en ligne pour commander facilement des 
                            <strong>fruits, légumes et produits alimentaires frais</strong>, sélectionnés avec soin auprès des meilleurs producteurs locaux.
                        </p>
                        <p class="text-center text-muted">
                            Notre objectif est simple : vous offrir des produits <strong>sains, naturels et savoureux</strong>, 
                            tout en garantissant une expérience d'achat moderne, rapide et sécurisée.
                        </p>
                    </div>

                    <!-- Mission Section -->
                    <div class="mission-section mb-5">
                        <h2 class="h3 text-success mb-4">
                            <i class="fas fa-bullseye me-2"></i>
                            Notre mission
                        </h2>
                        <p>Chez Fruitables, notre mission est de :</p>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Fournir des produits <strong>100% frais et de haute qualité</strong></li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Soutenir les <strong>producteurs locaux et l'agriculture durable</strong></li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Faciliter la <strong>commande en ligne</strong> avec une expérience simple et agréable</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Garantir la <strong>satisfaction totale de nos clients</strong></li>
                        </ul>
                        <p class="text-muted">Nous croyons que tout le monde mérite d'avoir accès à des aliments frais et sains au quotidien.</p>
                    </div>

                    <!-- Commitments Section -->
                    <div class="commitments-section mb-5">
                        <h2 class="h3 text-success mb-4">
                            <i class="fas fa-handshake me-2"></i>
                            Nos engagements
                        </h2>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="commitment-item d-flex align-items-start mb-3">
                                    <span class="badge bg-success rounded-circle p-2 me-3">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div>
                                        <strong>Produits frais sélectionnés chaque jour</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="commitment-item d-flex align-items-start mb-3">
                                    <span class="badge bg-success rounded-circle p-2 me-3">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div>
                                        <strong>Produits naturels et biologiques</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="commitment-item d-flex align-items-start mb-3">
                                    <span class="badge bg-success rounded-circle p-2 me-3">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div>
                                        <strong>Livraison rapide et sécurisée</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="commitment-item d-flex align-items-start mb-3">
                                    <span class="badge bg-success rounded-circle p-2 me-3">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div>
                                        <strong>Prix justes et transparents</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="commitment-item d-flex align-items-start mb-3">
                                    <span class="badge bg-success rounded-circle p-2 me-3">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <div>
                                        <strong>Service client professionnel et réactif</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Why Choose Us Section -->
                    <div class="why-choose-section mb-5">
                        <h2 class="h3 text-success mb-4">
                            <i class="fas fa-star me-2"></i>
                            Pourquoi choisir Fruitables ?
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-desktop text-primary mb-3" style="font-size: 2rem;"></i>
                                    <h5>Interface moderne et facile à utiliser</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-bolt text-primary mb-3" style="font-size: 2rem;"></i>
                                    <h5>Commande rapide en quelques clics</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-leaf text-primary mb-3" style="font-size: 2rem;"></i>
                                    <h5>Produits soigneusement sélectionnés</h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="feature-item">
                                    <i class="fas fa-shield-alt text-primary mb-3" style="font-size: 2rem;"></i>
                                    <h5>Paiement sécurisé</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Section -->
                    <div class="stats-section mb-5 text-center">
                        <h2 class="h3 text-success mb-4">
                            <i class="fas fa-chart-bar me-2"></i>
                            Nos chiffres
                        </h2>
                        <div class="row g-4">
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number text-primary fw-bold" style="font-size: 2.5rem;">1000+</div>
                                    <div class="stat-label text-muted">Clients satisfaits</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number text-primary fw-bold" style="font-size: 2.5rem;">50+</div>
                                    <div class="stat-label text-muted">Producteurs partenaires</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number text-primary fw-bold" style="font-size: 2.5rem;">100s</div>
                                    <div class="stat-label text-muted">Produits disponibles</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="stat-item">
                                    <div class="stat-number text-primary fw-bold" style="font-size: 2.5rem;">⭐</div>
                                    <div class="stat-label text-muted">Haut niveau de satisfaction</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vision Section -->
                    <div class="vision-section mb-5">
                        <h2 class="h3 text-success mb-4">
                            <i class="fas fa-eye me-2"></i>
                            Notre vision
                        </h2>
                        <p>Nous voulons devenir une plateforme de référence pour la vente de produits alimentaires frais en ligne, en connectant directement les producteurs aux consommateurs.</p>
                        <p class="text-muted">Nous travaillons chaque jour pour améliorer nos services, enrichir notre catalogue et offrir une expérience moderne et agréable.</p>
                    </div>

                    <!-- Thanks Section -->
                    <div class="thanks-section text-center">
                        <h2 class="h3 text-success mb-4">
                            <i class="fas fa-heart me-2"></i>
                            Merci de votre confiance
                        </h2>
                        <p class="fs-5">Fruitables est plus qu'un simple site e-commerce. C'est un partenaire qui vous accompagne chaque jour pour vous offrir le meilleur de la nature.</p>
                        <p class="lead text-primary fw-bold">Merci de faire confiance à <strong>Fruitables</strong> 🌿</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About Page End -->

<style>
.about-page {
    background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%);
}

.about-content {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

.commitment-item {
    padding: 1rem;
    border-radius: 10px;
    background: #f8f9fa;
    transition: transform 0.3s ease;
}

.commitment-item:hover {
    transform: translateY(-2px);
}

.feature-item {
    text-align: center;
    padding: 1.5rem;
    border-radius: 15px;
    background: #f8fff9;
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(40, 167, 69, 0.1);
}

.stat-item {
    padding: 2rem 1rem;
    border-radius: 15px;
    background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%);
    border: 2px solid #28a745;
    transition: transform 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
}

@media (max-width: 768px) {
    .about-content {
        padding: 2rem 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem !important;
    }
}
</style>
@endsection
