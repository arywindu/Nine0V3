<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title . ' - ' : '' ?>NINE 0 Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #F15A29;
            --primary-dark: #e14a1f;
            --secondary-color: #ff7849;
            --accent-color: #ffa366;
            --dark-bg: #2d3748;
            --darker-bg: #1a202c;
            --light-bg: #f7f8fc;
            --text-light: #a0aec0;
            --text-white: #ffffff;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --danger-color: #f56565;
            --border-radius: 12px;
            --card-shadow: 0 4px 20px rgba(0,0,0,0.08);
            --card-shadow-hover: 0 8px 30px rgba(0,0,0,0.12);
        }

        * {
            box-sizing: border-box;
        }

        body { 
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--light-bg);
            overflow-x: hidden;
        }
        
        /* Topbar */
        .admin-topbar { 
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 0.5rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1030;
        }
        
        .admin-topbar .navbar-brand { 
            color: var(--text-white) !important; 
            font-weight: 700;
            font-size: 1.25rem;
        }
        
        .admin-topbar .nav-link { 
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
        }
        
        .admin-topbar .nav-link:hover { 
            color: var(--text-white) !important;
        }
        
        /* Sidebar */
        .admin-sidebar { 
            background: var(--dark-bg);
            min-height: calc(100vh - 56px);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 56px;
            height: calc(100vh - 56px);
            overflow-y: auto;
        }
        
        .admin-sidebar .nav-link { 
            color: var(--text-light);
            padding: 14px 20px;
            border-radius: 8px;
            margin: 4px 12px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }
        
        .admin-sidebar .nav-link:hover { 
            background: rgba(241, 90, 41, 0.1);
            color: var(--text-white);
            border-left-color: var(--primary-color);
            transform: translateX(4px);
        }
        
        .admin-sidebar .nav-link.active { 
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-white);
            border-left-color: var(--accent-color);
            box-shadow: 0 4px 15px rgba(241, 90, 41, 0.3);
        }
        
        .admin-sidebar .nav-link i { 
            width: 22px; 
            margin-right: 12px;
            font-size: 1rem;
            text-align: center;
        }
        
        /* Main Content */
        .admin-content { 
            background: var(--light-bg);
            min-height: calc(100vh - 56px);
            overflow-y: auto;
        }
        
        .content-header { 
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 1.5rem 1.5rem;
            margin-bottom: 0;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .content-header h1 {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        /* Cards */
        .wp-card { 
            background: #ffffff;
            border: none;
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            margin-bottom: 1rem;
            overflow: hidden;
        }
        
        .wp-card:hover {
            transform: translateY(-2px);
            box-shadow: var(--card-shadow-hover);
        }

        .wp-card .card-header {
            background: #ffffff;
            border-bottom: 1px solid #f0f0f0;
            padding: 1rem 1.25rem;
        }

        .wp-card .card-header h5 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
        }

        .wp-card .card-body {
            padding: 1.25rem;
        }
        
        /* Stats Card */
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(241, 90, 41, 0.3);
        }
        
        .stats-card i {
            font-size: 2.5rem;
            margin-bottom: 0.75rem;
            opacity: 0.9;
            display: block;
        }
        
        .stats-card h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stats-card p {
            opacity: 0.9;
            font-size: 0.875rem;
        }
        
        /* Buttons */
        .btn-wp-primary { 
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 0.625rem 1.25rem;
            font-weight: 600;
            color: white;
            transition: all 0.3s ease;
        }
        
        .btn-wp-primary:hover { 
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(241, 90, 41, 0.4);
            color: white;
        }
        
        .btn-wp-success {
            background: linear-gradient(135deg, var(--success-color), #38a169);
            border: none;
            color: white;
        }
        
        .btn-wp-danger {
            background: linear-gradient(135deg, var(--danger-color), #e53e3e);
            border: none;
            color: white;
        }
        
        /* Tables */
        .table th {
            background: linear-gradient(135deg, #f8fafc, #edf2f7);
            border: none;
            font-weight: 600;
            color: var(--dark-bg);
            padding: 0.875rem 1rem;
            font-size: 0.875rem;
        }

        .table td {
            padding: 0.875rem 1rem;
            vertical-align: middle;
        }
        
        /* Badges */
        .badge {
            border-radius: 20px;
            padding: 0.4em 0.8em;
            font-weight: 500;
            font-size: 0.75rem;
        }
        
        /* Modals */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 1rem 1.5rem;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }
        
        /* Forms */
        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.625rem 0.875rem;
            border: 1px solid #e2e8f0;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(241, 90, 41, 0.15);
        }

        .form-label {
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.375rem;
            font-size: 0.875rem;
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 0.875rem 1.25rem;
        }
        
        /* Dropdowns */
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 0.5rem;
        }

        .dropdown-item {
            border-radius: 6px;
            padding: 0.5rem 1rem;
            transition: background 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(241, 90, 41, 0.1);
        }

        /* Responsive Mobile */
        @media (max-width: 767.98px) {
            .admin-sidebar {
                position: fixed;
                left: -100%;
                width: 250px;
                transition: left 0.3s ease;
                z-index: 1040;
            }
            
            .admin-sidebar.show {
                left: 0;
            }

            .admin-content {
                width: 100% !important;
            }

            .content-header {
                padding: 1rem;
            }

            .content-header h1 {
                font-size: 1.25rem;
            }

            .stats-card {
                padding: 1.25rem;
            }

            .stats-card h3 {
                font-size: 1.5rem;
            }

            .stats-card i {
                font-size: 2rem;
            }
        }

        /* Utility classes */
        .text-primary {
            color: var(--primary-color) !important;
        }

        /* Scrollbar styling */
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: var(--darker-bg);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: var(--text-light);
            border-radius: 3px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg admin-topbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('admin/dashboard') ?>">
                <i class="fas fa-cube"></i> NINE 0
            </a>
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> Admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                            <i class="fas fa-cog text-primary"></i> Settings
                        </a></li>
                        <li><a class="dropdown-item" href="<?= base_url() ?>" target="_blank">
                            <i class="fas fa-external-link-alt text-success"></i> View Site
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= base_url('admin/logout') ?>">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
