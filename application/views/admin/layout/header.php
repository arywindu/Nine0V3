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
            --light-bg: #fffbf0;
            --text-light: #a0aec0;
            --text-white: #ffffff;
            --success-color: #48bb78;
            --warning-color: #ed8936;
            --danger-color: #f56565;
        }

        body { font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; }
        
        .admin-topbar { 
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .admin-topbar .navbar-brand { 
            color: var(--text-white) !important; 
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .admin-topbar .nav-link { 
            color: rgba(255,255,255,0.9) !important;
            transition: all 0.3s ease;
        }
        
        .admin-topbar .nav-link:hover { 
            color: var(--text-white) !important;
            transform: translateY(-1px);
        }
        
        .admin-sidebar { 
            background: var(--dark-bg);
            min-height: calc(100vh - 56px);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }
        
        .admin-sidebar .nav-link { 
            color: var(--text-light);
            padding: 15px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .admin-sidebar .nav-link:hover { 
            background: rgba(102, 126, 234, 0.1);
            color: var(--text-white);
            border-left-color: var(--primary-color);
            transform: translateX(5px);
        }
        
        .admin-sidebar .nav-link.active { 
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-white);
            border-left-color: var(--accent-color);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .admin-sidebar .nav-link i { 
            width: 20px; 
            margin-right: 12px;
            font-size: 1.1rem;
        }
        
        .admin-content { 
            background: var(--light-bg);
            min-height: calc(100vh - 56px);
        }
        
        .content-header { 
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            padding: 25px 30px;
            margin-bottom: 25px;
            border-bottom: 1px solid #e2e8f0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .content-header h1 {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
        }
        
        .wp-card { 
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .wp-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .btn-wp-primary { 
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-wp-primary:hover { 
            background: linear-gradient(135deg, var(--primary-dark), var(--secondary-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
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
        
        .table th {
            background: linear-gradient(135deg, #f8fafc, #edf2f7);
            border: none;
            font-weight: 600;
            color: var(--dark-bg);
        }
        
        .badge {
            border-radius: 20px;
            padding: 6px 12px;
            font-weight: 500;
        }
        
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        .alert {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .dropdown-menu {
            border: none;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
        }
        
        .stats-card i {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }
        
        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 5px;
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
