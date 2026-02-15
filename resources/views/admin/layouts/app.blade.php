<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Fruitables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>

.sidebar {
    min-height: 100vh;
    background: linear-gradient(135deg, #18181b 0%, #27272a 50%, #18181b 100%);
    border-right: 2px solid #3b82f6;
    box-shadow: 2px 0 15px rgba(0,0,0,0.2);
}    
 .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            margin: 5px 10px;
            border-radius: 8px;
            transition: all 0.3s ease;
            
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
        
    background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        .main-content {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .navbar-brand {
            font-weight: bold;
            color: #764ba2 !important;
        }
        
        /* Custom Pagination Styles */
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

        /* Badges de paiement */
        .badge-payment-pending {
            background: #ffc107;
            color: #000;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .badge-payment-paid {
            background: #28a745;
            color: #fff;
            font-weight: 500;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Fruitables</h4>
                        <small class="text-white-50">Admin Panel</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                                <i class="fas fa-box"></i>
                                Produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-tags"></i>
                                Catégories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                Commandes
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}" href="{{ route('admin.customers.index') }}">
                                <i class="fas fa-users"></i>
                                Clients
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.messages.*') ? 'active' : '' }}" href="{{ route('admin.messages.index') }}">
                                <i class="fas fa-envelope"></i>
                                Messages
                              
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                                <i class="fas fa-cog"></i>
                                Paramètres
                            </a>
                        </li>
                        <li class="nav-item mt-4">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fas fa-home"></i>
                                Retour au site
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                Déconnexion
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-leaf text-success"></i> Fruitables Admin
                        </a>
                        <div class="d-flex align-items-center">
                            <!-- Icône Notifications -->
                            <div class="dropdown me-3">
                                <a class="btn btn-link position-relative" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell fa-lg text-dark"></i>
                                    @php
                                        // Compter uniquement les notifications NON LUES
                                        $newOrders = \App\Models\Order::whereNull('admin_viewed_at')->count();
                                        
                                        $newCustomers = \App\Models\AdminNotification::where('type', 'new_customer')
                                            ->where('is_read', false)
                                            ->count();
                                        
                                        $lowStockProducts = \App\Models\AdminNotification::where('type', 'low_stock')
                                            ->where('is_read', false)
                                            ->count();
                                        
                                        $unreadMessages = \App\Models\Contact::where('is_read', false)->count();
                                        
                                        $totalNotifications = $newOrders + $newCustomers + $lowStockProducts + $unreadMessages;
                                    @endphp
                                    
                                    @if($totalNotifications > 0)
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ $totalNotifications }}
                                        </span>
                                    @endif
                                </a>
                            
                                <!-- Dropdown Menu -->
                                <ul class="dropdown-menu dropdown-menu-end shadow" style="width: 320px; max-height: 400px; overflow-y: auto;">
                                    <li class="dropdown-header bg-light">
                                        <strong>Notifications</strong>
                                        <span class="badge bg-danger ms-2">{{ $totalNotifications }}</span>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    
                                    @if($totalNotifications === 0)
                                        <li class="text-center py-3 text-muted">
                                            <i class="fas fa-check-circle fa-2x mb-2"></i>
                                            <p>Aucune notification</p>
                                        </li>
                                    @else
                                        <!-- Nouvelles commandes -->
                                        @if($newOrders > 0)
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.orders.index') }}">
                                                <div class="me-3">
                                                    <div class="bg-success text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-shopping-cart"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <strong>{{ $newOrders }}</strong> nouvelle(s) commande(s)
                                                    <small class="text-muted d-block">Non vues</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        @endif
                                        
                                        <!-- Nouveaux clients -->
                                        @if($newCustomers > 0)
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.customers.index') }}">
                                                <div class="me-3">
                                                    <div class="bg-primary text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-user-plus"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <strong>{{ $newCustomers }}</strong> nouveau(x) client(s)
                                                    <small class="text-muted d-block">Dernières 24h</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        @endif
                                        
                                        <!-- Stock faible -->
                                        @if($lowStockProducts > 0)
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.products.index') }}">
                                                <div class="me-3">
                                                    <div class="bg-warning text-dark rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-exclamation-triangle"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <strong>{{ $lowStockProducts }}</strong> produit(s) en stock faible
                                                    <small class="text-muted d-block">Stock ≤ 5 unités</small>
                                                </div>
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        @endif
                                        
                                        <!-- Messages non lus -->
                                        @if($unreadMessages > 0)
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('admin.messages.index') }}">
                                                <div class="me-3">
                                                    <div class="bg-info text-white rounded-circle" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        <i class="fas fa-envelope"></i>
                                                    </div>
                                                </div>
                                                <div>
                                                    <strong>{{ $unreadMessages }}</strong> message(s) non lu(s)
                                                    <small class="text-muted d-block">À traiter</small>
                                                </div>
                                            </a>
                                        </li>
                                        @endif
                                    @endif
                                    
                                    <li><hr class="dropdown-divider"></li>
                                    <li class="text-center py-2">
                                        <small class="text-muted">Dernière mise à jour: {{ now()->format('H:i') }}</small>
                                    </li>
                                </ul>
                            </div>
                            
                            <!-- Reste du navbar (User info) -->
                            <span class="me-3">
                                <i class="fas fa-user-circle"></i>
                                {{ Auth::user()->full_name }}
                            </span>
                            <span class="badge bg-success">Admin</span>
                        </div>
                    </div>
                </nav>

                <!-- Flash messages -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Page content -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Logout form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
