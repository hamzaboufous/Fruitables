<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Facture - Fruitables')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary-color: #81c408;
            --primary-dark: #6fa506;
            --text-dark: #333;
            --text-light: #666;
            --border-color: #e9ecef;
            --bg-light: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: white;
            margin: 0;
            padding: 0;
            color: var(--text-dark);
            line-height: 1.6;
        }

        .invoice-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 40px;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid var(--primary-color);
        }

        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .logo i {
            font-size: 2rem;
        }

        .invoice-title {
            font-size: 2rem;
            font-weight: bold;
            color: var(--text-dark);
            margin: 20px 0 10px 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .invoice-subtitle {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            gap: 30px;
        }

        .info-block {
            flex: 1;
        }

        .info-block h6 {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 15px;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
        }

        .info-block p {
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .info-block strong {
            color: var(--text-dark);
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px 0;
        }

        .product-table th {
            background: var(--bg-light);
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--text-dark);
            border-bottom: 2px solid var(--border-color);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-table td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        .product-table tr:last-child td {
            border-bottom: none;
        }

        .product-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .product-info {
            display: flex;
            align-items: center;
        }

        .quantity-badge {
            background: var(--bg-light);
            padding: 5px 10px;
            border-radius: 15px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .price {
            font-weight: 600;
            color: var(--text-dark);
        }

        .total-section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid var(--primary-color);
        }

        .total-row {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 10px;
            font-size: 1rem;
        }

        .total-row.final {
            font-size: 1.3rem;
            font-weight: bold;
            color: var(--primary-color);
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid var(--border-color);
        }

        .total-label {
            min-width: 200px;
            text-align: right;
            padding-right: 20px;
        }

        .total-value {
            min-width: 100px;
            text-align: right;
            font-weight: 600;
        }

        .status-section {
            text-align: center;
            margin: 40px 0;
            padding: 20px;
            background: var(--bg-light);
            border-radius: 8px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--primary-color);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid var(--border-color);
        }

        .action-btn {
            padding: 12px 25px;
            border-radius: 25px;
            border: none;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.95rem;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-outline {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .footer-note {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            color: var(--text-light);
            font-size: 0.9rem;
        }

        /* Print Styles */
        @media print {
            body {
                background: white;
            }

            .invoice-container {
                margin: 0;
                padding: 20px;
                border: none;
                box-shadow: none;
                max-width: 100%;
            }

            .action-buttons {
                display: none;
            }

            .invoice-header {
                margin-bottom: 20px;
            }

            .logo {
                font-size: 2rem;
            }

            .invoice-title {
                font-size: 1.5rem;
            }

            .product-table th,
            .product-table td {
                padding: 10px;
                font-size: 0.9rem;
            }

            .footer-note {
                margin-top: 20px;
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .invoice-container {
                margin: 20px;
                padding: 20px;
            }

            .invoice-info {
                flex-direction: column;
                gap: 20px;
            }

            .product-info {
                flex-direction: column;
                align-items: flex-start;
                text-align: left;
            }

            .product-img {
                margin-right: 0;
                margin-bottom: 10px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .action-btn {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    @yield('content')

    <script>
        // Function pour imprimer
        function printInvoice() {
            window.print();
        }

        // Function pour télécharger (placeholder)
        function downloadPDF() {
            // Placeholder pour future implémentation PDF
            alert('Fonction de téléchargement PDF sera bientôt disponible.');
        }
    </script>
</body>
</html>
