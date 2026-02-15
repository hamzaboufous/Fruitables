<!-- Section Commentaires -->
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <!-- Message de succès -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h3 class="card-title mb-4">
                        <i class="fas fa-comments text-primary me-2"></i>
                        Avis des clients
                    </h3>

                    <!-- Formulaire d'ajout de commentaire -->
                    @auth
                    <div class="comment-form-section mb-5">
                        <h5 class="mb-3">Laissez votre avis</h5>
                        <form action="{{ route('comments.store') }}" method="POST" id="commentForm">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Note</label>
                                    <div class="rating-input">
                                        @for($i = 1; $i <= 5; $i++)
                                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="d-none" required>
                                            <label for="star{{ $i }}" class="star-label me-1" data-rating="{{ $i }}">
                                                <i class="fas fa-star"></i>
                                            </label>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="comment" class="form-label fw-semibold">Votre commentaire</label>
                                <textarea class="form-control" id="comment" name="comment" rows="4" 
                                          placeholder="Partagez votre expérience avec ce produit..." required></textarea>
                                <div class="form-text">Minimum 10 caractères, maximum 1000 caractères</div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-paper-plane me-2"></i>
                                Envoyer mon avis
                            </button>
                        </form>
                    </div>
                    @else
                    <div class="alert alert-info mb-4">
                        <i class="fas fa-info-circle me-2"></i>
                        <a href="{{ route('login') }}" class="alert-link">Connectez-vous</a> pour laisser un avis sur ce produit.
                    </div>
                    @endauth

                    <!-- Liste des commentaires -->
                    <div class="comments-section" id="commentsSection">
                        <h5 class="mb-4">{{ $product->comments->count() }} avis</h5>
                        
                        @if($product->comments->count() > 0)
                            @foreach($product->comments->sortByDesc('created_at') as $comment)
                                @if(session('new_comment') && $loop->first)
                                    <div class="comment-card mb-4 p-3 border rounded-3 new-comment" style="animation: highlightNew 2s ease;">
                                @else
                                    <div class="comment-card mb-4 p-3 border rounded-3">
                                @endif
                                    <div class="d-flex align-items-start">
                                        <!-- Avatar utilisateur -->
                                        <div class="user-avatar me-3">
                                            @if($comment->user->avatar)
                                                <img src="{{ asset('storage/' . $comment->user->avatar) }}" 
                                                     alt="{{ $comment->user->full_name }}" 
                                                     class="rounded-circle" width="50" height="50">
                                            @else
                                                <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary text-white" 
                                                     style="width: 50px; height: 50px; font-weight: bold;">
                                                    {{ substr($comment->user->full_name, 0, 1) }}
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <!-- Contenu du commentaire -->
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <div>
                                                    <h6 class="mb-0 fw-semibold">{{ $comment->user->full_name }}</h6>
                                                    <small class="text-muted">{{ $comment->formatted_date }}</small>
                                                </div>
                                                <div class="stars-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $comment->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="mb-0">{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Soyez le premier à donner votre avis sur ce produit !</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.comment-form-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 15px;
    border: 1px solid #e9ecef;
}

.rating-input {
    display: flex;
    align-items: center;
    gap: 5px;
}

.star-label {
    font-size: 1.5rem;
    color: #ddd;
    cursor: pointer;
    transition: all 0.2s ease;
}

.star-label:hover,
.star-label:hover ~ .star-label {
    color: #ffc107;
}

input[type="radio"]:checked + .star-label {
    color: #ffc107;
}

input[type="radio"]:checked + .star-label ~ .star-label {
    color: #ddd;
}

.comment-card {
    background: white;
    transition: all 0.3s ease;
    border: 1px solid #f0f0f0 !important;
}

.comment-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
}

.avatar-placeholder {
    background: linear-gradient(135deg, #28a745, #20c997) !important;
}

.stars-rating {
    font-size: 0.9rem;
}

.form-control:focus {
    border-color: #28a745;
    box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
}

.btn-primary {
    background: linear-gradient(135deg, #28a745, #20c997);
    border: none;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #218838, #1ea085);
    transform: translateY(-1px);
}

.new-comment {
    border-left: 4px solid #28a745 !important;
    background-color: #f8fff9 !important;
}

@keyframes highlightNew {
    0% {
        background-color: #28a745;
        color: white;
    }
    100% {
        background-color: white;
        color: inherit;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des étoiles de notation
    const stars = document.querySelectorAll('.star-label');
    const ratingInput = document.querySelector('input[name="rating"]:checked');
    
    stars.forEach(star => {
        star.addEventListener('click', function() {
            const rating = parseInt(this.dataset.rating);
            updateStars(rating);
        });
        
        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.dataset.rating);
            updateStars(rating);
        });
    });
    
    document.querySelector('.rating-input').addEventListener('mouseleave', function() {
        const checkedRating = document.querySelector('input[name="rating"]:checked');
        if (checkedRating) {
            updateStars(parseInt(checkedRating.value));
        } else {
            updateStars(0);
        }
    });
    
    function updateStars(rating) {
        stars.forEach((star, index) => {
            if (index < rating) {
                star.style.color = '#ffc107';
            } else {
                star.style.color = '#ddd';
            }
        });
    }
    
    // Initialiser les étoiles si une note est déjà sélectionnée
    if (ratingInput) {
        updateStars(parseInt(ratingInput.value));
    }
});
</script>
