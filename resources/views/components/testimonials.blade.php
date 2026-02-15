<!-- Section Avis des Clients -->
<div class="container-fluid testimonial-section py-5" style="background: linear-gradient(135deg, #f8fff9 0%, #ffffff 100%);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-primary mb-3">
                <i class="fas fa-heart text-danger me-2"></i>
                Avis de nos clients
            </h2>
            <p class="lead text-muted">Découvrez ce que nos clients pensent de nos produits frais</p>
        </div>

        <div class="row g-4">
            @forelse($recentComments as $comment)
                <!-- Témoignage 1 -->
                <div class="col-lg-4 col-md-6">
                    <div class="testimonial-card h-100">
                        <div class="card-body p-4">
                            <!-- En-tête du témoignage -->
                            <div class="d-flex align-items-center mb-3">
                                <!-- Avatar -->
                                <div class="user-avatar me-3">
                                    @if($comment->user->avatar)
                                        <img src="{{ asset('storage/' . $comment->user->avatar) }}" 
                                             alt="{{ $comment->user->full_name }}" 
                                             class="rounded-circle border-2 border-white shadow" 
                                             width="60" height="60">
                                    @else
                                        <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary text-white shadow" 
                                             style="width: 60px; height: 60px; font-weight: bold; font-size: 1.2rem;">
                                            {{ substr($comment->user->full_name, 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Infos utilisateur -->
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-semibold">{{ $comment->user->full_name }}</h6>
                                    <div class="stars-rating mb-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $comment->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <small class="text-muted">{{ $comment->formatted_date }}</small>
                                </div>
                            </div>
                            
                            <!-- Produit concerné -->
                            <div class="product-reference mb-3">
                                <small class="text-muted d-block">
                                    <i class="fas fa-shopping-basket me-1"></i>
                                    Avis sur : <span class="fw-semibold">{{ $comment->product->name }}</span>
                                </small>
                            </div>
                            
                            <!-- Commentaire -->
                            <p class="testimonial-text mb-0">
                                "{{ $comment->comment }}"
                            </p>
                        </div>
                        
                        <!-- Badge de recommandation -->
                        <div class="card-footer bg-transparent border-0 pt-0">
                            <div class="text-center">
                                <span class="badge bg-success rounded-pill px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>
                                    Client satisfait
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Message si aucun commentaire -->
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="fas fa-comment-slash fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Aucun avis pour le moment</h4>
                        <p class="text-muted">Soyez le premier à partager votre expérience !</p>
                        <a href="{{ route('shop') }}" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-shopping-bag me-2"></i>
                            Découvrir nos produits
                        </a>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Bouton Voir plus -->
        @if($recentComments->count() >= 6)
        <div class="text-center mt-5">
            <a href="{{ route('shop') }}" class="btn btn-outline-primary rounded-pill px-5 py-3">
                <i class="fas fa-comments me-2"></i>
                Voir tous les avis
            </a>
        </div>
        @endif
    </div>
</div>

<style>
.testimonial-section {
    position: relative;
    overflow: hidden;
}

.testimonial-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(40, 167, 69, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 0;
}

.testimonial-section::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(32, 201, 151, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    z-index: 0;
}

.testimonial-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0;
    position: relative;
    z-index: 1;
    overflow: hidden;
}

.testimonial-card::before {
    content: '"';
    position: absolute;
    top: -10px;
    left: 20px;
    font-size: 80px;
    color: rgba(40, 167, 69, 0.1);
    font-family: Georgia, serif;
    z-index: 0;
}

.testimonial-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.avatar-placeholder {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
}

.stars-rating {
    font-size: 0.9rem;
}

.testimonial-text {
    font-style: italic;
    line-height: 1.6;
    color: #495057;
    position: relative;
    z-index: 1;
}

.product-reference {
    background: #f8f9fa;
    padding: 8px 12px;
    border-radius: 10px;
    border-left: 3px solid #28a745;
}

.badge {
    font-size: 0.85rem;
}

@media (max-width: 768px) {
    .testimonial-card {
        margin-bottom: 20px;
    }
    
    .display-5 {
        font-size: 2rem;
    }
}
</style>
