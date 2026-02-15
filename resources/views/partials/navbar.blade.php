<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('home') }}" class="navbar-brand"><h1 class="text-primary display-6">Fruitables</h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('home') }}" class="nav-item nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Accueil</a>
                    <a href="{{ route('shop') }}" class="nav-item nav-link {{ request()->routeIs('shop') ? 'active' : '' }}">Boutique</a>
                    <a href="{{ route('about') }}" class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">À propos</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
                </div>
                <div class="navbar-icons d-flex align-items-center gap-3 m-3 me-0">
                    <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                    
                    <!-- Panier -->
                    <a href="{{ route('cart') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-bag fa-2x"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ Auth::check() ? Auth::user()->cartItems()->count() : 0 }}</span>
                    </a>

                    <!-- Compte avec dropdown -->
                    @auth
                    <div class="dropdown">
                        <a href="#" class="dropdown-toggle my-auto" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user fa-2x"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0" style="min-width: 200px; margin-top: 10px;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('account') }}">
                                    <i class="fas fa-user me-3 text-primary"></i> 
                                    <span>Mon compte</span>
                                </a>
                            </li>

                            @if(auth()->check() && auth()->user()->is_admin)
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2 text-primary" href="{{ url('/admin/dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-3"></i> 
                                    <span>Dashboard Admin</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-2"></li>
                            @endif

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center py-2 text-danger">
                                        <i class="fas fa-sign-out-alt me-3"></i> 
                                        <span>Déconnexion</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @else
                        <a href="{{ route('login') }}" class="my-auto">
                            <i class="fas fa-user fa-2x"></i>
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>

<!-- Styles pour les effets hover -->
<style>
.navbar-icons i {
    transition: all 0.3s ease;
    color: #6c757d;
}

.navbar-icons i:hover {
    color: #28a745;
    transform: scale(1.15);
}

.dropdown-toggle::after {
    display: none;
}

.dropdown-menu {
    border: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    animation: fadeInUp 0.3s ease;
}

.dropdown-item {
    transition: all 0.3s ease;
    border-radius: 8px;
    margin: 2px 0;
}

.dropdown-item:hover {
    background-color: #f8fff9;
    color: #28a745;
    transform: translateX(5px);
}

.dropdown-item.text-danger:hover {
    background-color: #fff5f5;
    color: #dc3545;
}

.dropdown-item.text-primary:hover {
    background-color: #e7f3ff;
    color: #0056b3;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
<!-- Navbar End -->

<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rechercher par mot-clé</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <form action="{{ route('search') }}" method="GET" class="input-group w-75 mx-auto d-flex">
                    <input type="search" name="q" class="form-control p-3" placeholder="mots-clés" value="{{ request('q') }}">
                    <button type="submit" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Search End -->
