<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login - NINE 0 Studio</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('src/favIcon/favicon.jpg') ?>">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('main.css') ?>">
    <!-- Custom Font -->
    <link href="https://db.onlinewebfonts.com/c/0d37e976ab1e70a9e6a2b3659d180603?family=Square+721+Extended" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <style>
        body { 
            background: #f8f9fa; 
            font-family: 'Inter', Arial, sans-serif;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
        }
        .login-left {
            background: linear-gradient(135deg, #F15A29 0%, #ff7849 100%);
            color: white;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .login-right {
            padding: 3rem;
        }
        .login-title {
            font-family: 'Square 721 Extended', sans-serif;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #F15A29;
            box-shadow: 0 0 0 0.2rem rgba(241, 90, 41, 0.25);
        }
        .btn-login {
            background: linear-gradient(135deg, #F15A29 0%, #ff7849 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(241, 90, 41, 0.4);
            color: white;
        }
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px;
        }
        .back-home {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }
        .back-home:hover {
            color: #F15A29;
        }
    </style>
</head>
<body>
    <a href="<?= base_url() ?>" class="back-home">
        ← Back to Home
    </a>
    
    <div class="login-container">
        <div class="login-card">
            <div class="row g-0">
                <div class="col-md-6 login-left">
                    <img src="<?= base_url('src/logo/logo.svg') ?>" alt="NINE 0 Logo" style="height: 60px; margin-bottom: 2rem;">
                    <h2 class="login-title">ADMIN PANEL</h2>
                    <p class="mb-4">Welcome back! Please sign in to manage your portfolio and content.</p>
                    <div class="mt-4">
                        <small style="opacity: 0.8;">
                            PT Nawa Surya Kharisma<br>
                            Creative Design & Digital Marketing
                        </small>
                    </div>
                </div>
                
                <div class="col-md-6 login-right">
                    <div class="text-center mb-4">
                        <h3 style="color: #2d3748; font-weight: 600;">Sign In</h3>
                        <p class="text-muted">Enter your credentials to access admin panel</p>
                    </div>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i><?= $error ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label" style="color: #2d3748; font-weight: 500;">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label" style="color: #2d3748; font-weight: 500;">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                        </div>
                        
                        <button type="submit" class="btn btn-login">
                            Sign In to Admin Panel
                        </button>
                        
                        <div class="text-center mt-4">
                            <!-- <small class="text-muted">
                                Default credentials: <strong>admin</strong> / <strong>password</strong>
                            </small> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
