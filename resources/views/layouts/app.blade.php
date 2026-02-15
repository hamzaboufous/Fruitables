<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <title>Fruitables - Site E-commerce de Fruits et Légumes</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('assets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
        
        <!-- Custom Pagination Styles -->
        <style>
            .pagination {
                font-size: 14px;
                margin: 0;
            }

            .pagination .page-link {
                padding: 6px 12px;
                border-radius: 6px;
                margin: 0 2px;
                border: 1px solid #dee2e6;
                color: #6c757d;
                transition: all 0.2s ease;
            }

            .pagination .page-link:hover {
                background-color: #e9ecef;
                border-color: #dee2e6;
                color: #495057;
            }

            .pagination .page-item.active .page-link {
                background-color: #198754;
                border-color: #198754;
                color: white;
            }

            .pagination .page-item.disabled .page-link {
                color: #adb5bd;
                pointer-events: none;
            }

            .pagination .page-item:first-child .page-link,
            .pagination .page-item:last-child .page-link {
                font-weight: bold;
            }
        </style>
        
        @stack('styles')
    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        <!-- Navbar start -->
        @if (!request()->routeIs('login') && !request()->routeIs('register'))
            @include('partials.navbar')
        @endif
        <!-- Navbar End -->

        <!-- Main Content -->
        <main>
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('content')
        </main>

        <!-- Footer -->
        @if (!request()->routeIs('login') && !request()->routeIs('register'))
            @include('partials.footer')
        @endif
        <!-- Footer End -->

        <!-- Back to Top -->
        @if (!request()->routeIs('login') && !request()->routeIs('register'))
            <a href="#" class="btn btn-primary border-3 border-secondary py-2 px-4 rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>
        @endif

        <!-- JavaScript Libraries -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
        <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>
        <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

        <!-- Template Javascript -->
        <script src="{{ asset('assets/js/main.js') }}"></script>
        @stack('scripts')
    </body>
</html>
