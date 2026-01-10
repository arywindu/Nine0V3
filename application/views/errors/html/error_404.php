<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Define base URL manually for error pages
$base_url = 'http://localhost:8080/Nine0V3/';
// Alternative: detect from server
if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    
    // Check if running on localhost to keep the subdirectory
    if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false || strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
         $base_url = $protocol . $_SERVER['HTTP_HOST'] . '/Nine0V3/';
    } else {
         $base_url = $protocol . $_SERVER['HTTP_HOST'] . '/';
    }
}
?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>404 - Page Not Found | NINE 0 Studio</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $base_url ?>src/favIcon/favicon.jpg">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $base_url ?>src/favIcon/favicon.jpg">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Font -->
    <link href="https://db.onlinewebfonts.com/c/0d37e976ab1e70a9e6a2b3659d180603?family=Square+721+Extended" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <style>
        body {
            background: #FFE600;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
            padding: 0;
        }
        .error-header {
            padding: 1rem 1.5rem;
        }
        .error-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .error-content {
            display: flex;
            align-items: center;
            gap: 3rem;
            max-width: 900px;
        }
        .error-left {
            flex-shrink: 0;
        }
        .error-left img {
            width: 200px;
            height: auto;
        }
        .error-right {
            text-align: left;
        }
        .error-code {
            font-family: 'Square 721 Extended', Arial, sans-serif;
            font-size: 8rem;
            font-weight: bold;
            color: #333333;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        .error-divider {
            width: 6px;
            height: 60px;
            background: #F15A29;
            margin-bottom: 1rem;
        }
        .error-title {
            font-family: 'Square 721 Extended', Arial, sans-serif;
            font-size: 1.5rem;
            color: #333333;
            margin-bottom: 1rem;
        }
        .error-message {
            font-family: 'Inter', Arial, sans-serif;
            font-size: 14px;
            color: #333333;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        .error-message span {
            color: #F15A29;
        }
        .btn-home {
            display: inline-block;
            background: #F15A29;
            color: #333333;
            padding: 12px 28px;
            text-decoration: none;
            font-family: 'Square 721 Extended', Arial, sans-serif;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .btn-home:hover {
            background: #FF5E00;
            color: #333333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(241, 90, 41, 0.4);
        }
        .footer-info {
            text-align: center;
            padding: 1.5rem;
            font-family: 'Inter', Arial, sans-serif;
            font-size: 12px;
            color: #333333;
        }
        @media (max-width: 767.98px) {
            .error-content {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }
            .error-left img {
                width: 150px;
            }
            .error-right {
                text-align: center;
            }
            .error-code {
                font-size: 5rem;
            }
            .error-divider {
                margin-left: auto;
                margin-right: auto;
            }
            .error-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Error Content -->
    <div class="error-container">
        <div class="error-content">
   
            <div>
                <div class="error-code">404</div>
                <div class="error-divider"></div>
                <h1 class="error-title">PAGE NOT FOUND</h1>
                <p class="error-message">
                    <span><b>Oops! The page you're looking for doesn't exist or has been moved.</b></span><br>
                    Halaman yang Anda cari tidak ditemukan atau telah dipindahkan.
                </p>
                <a href="<?= $base_url ?>" class="btn-home">
                    ← BACK TO HOME
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer-info">
        Copyright © <?= date('Y') ?> PT NAWA SURYA KHARISMA. All rights reserved.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>