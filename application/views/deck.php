<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('src/favIcon/favicon.jpg') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('src/favIcon/favicon.jpg') ?>">
    <!-- SEO Meta Tags -->
    <meta name="description" content="<?= $meta_description ?>">
    <meta name="keywords" content="Nine 0, design, creative, branding, digital marketing, Jakarta, Bali, PT Nawa Surya Kharisma, company deck">
    <meta name="author" content="NINE 0 Studio">
    <meta property="og:title" content="<?= $title ?>">
    <meta property="og:description" content="<?= $meta_description ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= base_url() ?>">
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('main.css') ?>">
    <!-- Custom Font -->
    <link href="https://db.onlinewebfonts.com/c/0d37e976ab1e70a9e6a2b3659d180603?family=Square+721+Extended" rel="stylesheet">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <style>
        @media (max-width: 767.98px) {
            .img-mobile { width: 80vw; max-width: 100%; height: auto; }
            .custom-desc { width: 100% !important; max-width: 100% !important; font-size: 13px !important; padding: 0 8px; }
        }
        @media (min-width: 768px) {
            .custom-desc { width: 48rem !important; max-width: 100%; }
        }
        .download-btn {
            display: inline-block;
            background: #F15A29;
            color: #333333;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-family: 'Square 721 Extended', Arial, sans-serif;
            font-weight: bold;
            transition: all 0.3s ease;
            margin-top: 16px;
        }
        .download-btn:hover {
            background: #FF5E00;
            color: #333333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(241, 90, 41, 0.3);
        }
    </style>
</head>
<body>
    <main class="container d-flex flex-column min-vh-100">
        <div class="d-flex align-items-start gap-2 gap-md-3 mt-3">
            <img src="<?= base_url('src/logo/logo.svg') ?>" alt="Logo Nine 0" style="height:48px;">
            <span class="customGrey" style="font-size: 7px; vertical-align: top;">#HEADER_LOGO</span>
        </div>
        <div class="container-fluid mt-4">
            <div class="row">
                <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-3 mb-md-0">
                    <img src="<?= base_url('src/img/mascot.png') ?>" alt="Mascot Nine 0" class="img-mobile img-fluid">
                </div>
                <div class="col-12 col-md-7 gx-2">
                    <p class="customOrange" style="font-size: 14px;">// ONLINE PRESENTATION DECK</p>
                    <div class="d-flex align-items-center justify-content-start">
                        <span style="display:inline-block;width:6px;height:38px;background:#F15A29;margin-right:16px;border-radius:0px;"></span>
                        <h1 class="mb-0 customBlack d-md-none d-block">LIMITED <br> ACCESS</h1>
                        <h1 class="mb-0 customBlack d-none d-md-block">LIMITED ACCESS</h1>
                    </div>
                    <div class="d-flex align-items-center mt-4 mt-md-5">
                        <p class="customBlack" style="font-size: 14px;">// PASSWORD</p>
                    </div>
                    <form id="passwordForm" class="d-flex align-items-center">
                        <input id="passwordInput" type="password" style="width: 40%;" class="form-control bg-dark text-white border-0 rounded-0" placeholder="Password" required>
                        <button type="submit" class="btn bg-transparent border-0 ms-4 p-0">
                            <img src="<?= base_url('src/icon/right.svg') ?>" style="width: 24px; height: auto; display: block; cursor: pointer;">
                        </button>
                    </form>
                    <div id="passwordError" class="mt-2" style="display: none;">
                        <small class="text-danger"></small>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <p class="customBlack text-wrap lh-sm custom-desc" style="font-size: 14px; font-family: 'Inter', Arial, sans-serif; text-align: justify">          
                            
                            <span class="customOrange"><b>Your password will expire in 7 days. Please contact us again if you need a new password.</b><br>
                            Password anda akan kedaluwarsa dalam 7 hari. Mohon menghubungi kami kembali apabila anda<br> memerlukan password baru.</span><br>                       
                        </p>
                    </div>
                    
                
                

             <div class="d-flex align-items-center p-3" style=" border-radius: 4px; min-height: 80px;">
    
                <div class="me-3">      
                    <img src="<?= base_url('src/icon/icon-wifi.svg') ?>" style="width: 50px; height: auto; display: block;">
                </div>

                <p class="m-0 text-wrap lh-sm" style="font-size: 14px; font-family: 'Inter', Arial, sans-serif; color: #000;">
                    <b style="display: block; margin-bottom: 2px;">
                        Please ensure a stable, high-speed internet connection to allow all page elements to <br class="d-none d-md-block">load properly.
                    </b>
                    <span>
                        Mohon pastikan koneksi internet anda stabil dan cepat agar seluruh elemen pada <br class="d-none d-md-block"> halaman dapat ditampilkan dengan baik.
                    </span>
                </p>
            </div>

            <div class="d-flex align-items-center p-3" style=" border-radius: 4px; min-height: 80px;">
    
                <div class="me-3">      
                    <img src="<?= base_url('src/icon/icon-laptop.svg') ?>" style="width: 50px; height: auto; display: block;">
                </div>

                <p class="m-0 text-wrap lh-sm" style="font-size: 14px; font-family: 'Inter', Arial, sans-serif; color: #000;">
                    <b style="display: block; margin-bottom: 2px;">
                        For optimal performance and layout accuracy, this page is best accessed on a desktop computer or laptop.
                    </b>
                    <span>
                       Untuk performa yang optimal dan layout yang akurat, halaman ini disarankan untuk <br> diakses melalui komputer desktop atau laptop.
                    </span>
                </p>
            </div>

                </div>
            </div>
        </div>
        <div class="mt-5">
            <footer class="container-fluid py-5">
                <div class="row justify-content-center align-items-start gx-5">
                    <div class="col-12 col-md-2 d-flex flex-column align-items-md-start align-items-center mb-4 mb-md-0">
                        <img src="src/img/footerNine.svg" alt="Logo Nine 0 Jakarta">
                        <p class="mt-4 mb-0 text-md-start text-center" style="font-size: 12px; font-family: 'Inter', Arial, sans-serif; max-width: 220px;">
                            PT Nawa Surya Kharisma<br>
                            Jl. KH Soleh Ali No.58A, RT. 004 / RW. 011
                            Tangerang, Banten, 15118
                        </p>
                    </div>
                    <div class="col-12 col-md-2 mt-3 mt-md-0 d-flex flex-column align-items-md-start align-items-center">
                        <img src="src/img/footerNineBali.svg" style="margin-top: -15px;" alt="Logo Nine 0 Bali">
                        <p class="mt-md-4 text-md-start text-center" style="font-size: 12px; font-family: 'Inter', Arial, sans-serif; max-width: 220px;">
                            Jl. Batu Belig Gg. Daksina No.1<br>
                            Kerobokan Kelod, Kuta Utara,<br>
                            Badung, Bali, 80361
                        </p>
                    </div>
                    <div class="col-12 col-md-2 d-flex flex-column align-items-md-start align-items-center mb-md-4 mb-3">
                        <div class="mt-2 mt-md-5" >
                        <p class="mt-md-4 mb-0 text-md-start text-center" style="font-size: 12px; font-family: 'Inter', Arial, sans-serif; max-width: 220px;">
                            www.nine0.co.id<br>
                            (021) 557 988 77<br>
                            +62 812 90909 587 (WA)
                        </p>
                        </div>
                    </div>
                    <div class="col-12 col-md d-flex flex-column align-items-md-end align-items-center">
                        <div class="mt-md-2">
                        <p class="mt-md-4 mb-0 text-md-end text-center align-item-start" style="font-size: 12px; font-family: 'Inter', Arial, sans-serif; ">
                            <a class="text-decoration-none customeBlack" href="https://www.instagram.com/nine0.co.id/" target="_blank" >INSTAGRAM</a><br>
                            <a class="text-decoration-none customeBlack" href="https://api.whatsapp.com/send/?phone=6281290909587&text&type=phone_number&app_absent=0" target="_blank" >WHATSAPP</a><br>
                            <a class="text-decoration-none customeBlack" href="mailto:cs@nine0.co.id" target="_blank" >EMAIL</a>
                        <div class="col-12 text-md-end mt-3">
                        <small style="font-size: 12px; font-family: 'Inter', Arial, sans-serif;">
                            Copyright © <?= date('Y') ?> PT NAWA SURYA KHARISMA. All rights reserved.
                        </small>
                        </div>
                        </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    <!-- Success Modal with Iframe -->
<div class="modal fade" id="successModal" tabindex="-1"
     data-bs-backdrop="static" data-bs-keyboard="false">

    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-theme-yellow"
             style="height:100vh; overflow:hidden; position:relative;">

            <!-- HEADER -->
            <div class="modal-header border-0 py-2" style="flex-shrink:0;">
                <div class="d-flex align-items-center">
                    <img src="src/logo/logo.svg" alt="Logo Nine 0"
                         style="height:40px;" class="me-3">
                    <div>
                        <h5 class="mb-0 customBlack">LIMITED ACCESS GRANTED</h5>
                        <small class="customOrange" style="font-size:12px;">
                            Password expires: <span id="expiryDate"></span>
                        </small>
                    </div>
                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <!-- BODY -->
            <div class="modal-body p-0" style="flex:1; overflow:hidden;">
                <iframe id="deckIframe"
                        style="width:100%; height:100%; border:none; display:block;"
                        allowfullscreen>
                </iframe>
            </div>

            <!-- NOTE / SHORTCUT -->
            <!-- <div style="
                position:absolute;
                bottom:16px;
                right:20px;
                background:rgba(0,0,0,0.65);
                color:#fff;
                padding:6px 12px;
                border-radius:6px;
                font-size:12px;
                font-family:'Inter', Arial, sans-serif;
                z-index:1056;
                pointer-events:none;
            ">
                ⌨ Press <b>Z</b> to toggle screen fit / content scale
            </div> -->

        </div>
    </div>
</div>


    <!-- Error Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-0 text-center" style="background:#333333;">

            <!-- HEADER -->
            <div class="modal-header border-0 position-relative justify-content-center">

                <h5 class="modal-title customOrange w-100 text-center"
                    style="font-family:'Square 721 Extended', Arial, sans-serif;">
                    // WRONG PASSWORD
                </h5>

                <button type="button"
                        class="btn-close btn-close-white position-absolute end-0 me-3"
                        data-bs-dismiss="modal">
                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body text-center">
                <p id="errorMessage"
                   class="text-white fw-bold mb-0"
                   style="font-family:'Inter', Arial, sans-serif; font-size:14px;">
                </p>
                <p
                   class="text-white mb-0"
                   style="font-family:'Inter', Arial, sans-serif; font-size:14px;">
                   <b>Sorry, the password you entered is incorrect. <br> Please try again</b> <br>
                   Maaf, password yang anda masukkan salah.<br> Silakan coba lagi.
                </p>
              
            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 justify-content-center">
                <button type="button"
                        class="btn btn-sm text-white"
                        data-bs-dismiss="modal"
                        style="border:none; padding:8px 20px; font-family:'Square 721 Extended', Arial, sans-serif;">
                    <h4><b>OK</b></h4>  
                </button>
            </div>

        </div>
    </div>
</div>


    <script>
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const password = document.getElementById('passwordInput').value;
            const errorDiv = document.getElementById('passwordError');
            const submitBtn = this.querySelector('button[type="submit"]');
            
            // Disable submit button
            submitBtn.disabled = true;
            
            // Hide previous errors
            errorDiv.style.display = 'none';
            
            // Send AJAX request
            fetch('<?= base_url('verify-deck-password') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'password=' + encodeURIComponent(password)
            })
            .then(response => response.json())
            .then(data => {
                submitBtn.disabled = false;
                
                if (data.success) {
                    // Success - show modal with iframe
                    document.getElementById('deckIframe').src = data.deck_url;
                    document.getElementById('expiryDate').textContent = data.expires_at;
                    const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                    successModal.show();
                } else {
                    // Error - show error modal
                    document.getElementById('errorMessage').textContent = data.message;
                    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                    errorModal.show();
                    
                    // Clear password field
                    document.getElementById('passwordInput').value = '';
                }
            })
            .catch(error => {
                submitBtn.disabled = false;
                console.error('Error:', error);
                document.getElementById('errorMessage').textContent = 'An error occurred. Please try again.';
                const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                errorModal.show();
            });
        });

        // Clear iframe when modal is closed
        const successModalEl = document.getElementById('successModal');
        successModalEl.addEventListener('hidden.bs.modal', function () {
            document.getElementById('deckIframe').src = '';
            document.getElementById('passwordInput').value = ''; // Clean input as well
        });
    </script>
</body>
</html>
