<!-- Footer Start -->
<div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h3 class="text-white mb-4">Fruitables</h3>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-2"></i>M6 Street, Guelmim, Maroc</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-2"></i>+212 651997956</p>
                <p class="mb-2"><i class="fa fa-envelope me-2"></i>admin@fruitables.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                    <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Menu</h4>
                <a class="btn btn-link text-white-50" href="{{ route('home') }}">Accueil</a>
                <a class="btn btn-link text-white-50" href="{{ route('shop') }}">Boutique</a>
                <a class="btn btn-link text-white-50" href="{{ route('about') }}">À propos</a>
                <a class="btn btn-link text-white-50" href="{{ route('contact') }}">Contact</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Categories</h4>
                @php
                    $footerCategories = \App\Models\Category::where('is_active', true)->orderBy('sort_order')->take(5)->get();
                @endphp
                @foreach($footerCategories as $category)
                <a class="btn btn-link text-white-50" href="#">{{ $category->name }}</a>
                @endforeach
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-4">Newsletter</h4>
                <p>Inscrivez-vous à notre newsletter pour recevoir les dernières offres.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Votre email">
                    <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">S'inscrire</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="#">Fruitables</a>, Tous droits réservés.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <div class="footer-menu">
                        <a href="{{ route('home') }}">Accueil</a>
                        <a href="#">Cookies</a>
                        <a href="#">Aide</a>
                        <a href="#">FAQs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->
