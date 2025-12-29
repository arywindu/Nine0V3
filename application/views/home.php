<?php $this->load->view('layout/header'); ?>

<div class="container-fluid bg-dark text-white min-vh-100 d-flex align-items-center">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="display-1 fw-bold mb-4" style="font-family: 'Square 721 Extended', sans-serif;">
                    VER 3.0 IS COMING SOON
                </h1>
                <p class="lead mb-4 custom-desc mx-auto">
                    NINE 0 is a design company based in Jakarta and Bali, specializing in creative direction, 
                    brand identity, and digital marketing.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="<?= base_url('portfolio') ?>" class="btn btn-outline-light btn-lg">
                        View Portfolio
                    </a>
                    <a href="#contact" class="btn btn-light btn-lg text-dark">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-12">
                <div class="marquee-container">
                    <div class="marquee">
                        <span>CREATIVE DESIGN • BRAND IDENTITY • DIGITAL MARKETING • WEB DEVELOPMENT • </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.marquee-container {
    overflow: hidden;
    white-space: nowrap;
    border-top: 1px solid #333;
    border-bottom: 1px solid #333;
    padding: 15px 0;
}

.marquee {
    display: inline-block;
    animation: scroll 20s linear infinite;
    font-size: 1.2rem;
    font-weight: bold;
}

@keyframes scroll {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}

.custom-desc {
    max-width: 600px;
}

@media (max-width: 768px) {
    .display-1 { font-size: 2.5rem; }
    .custom-desc { font-size: 1rem; }
}
</style>

<?php $this->load->view('layout/footer'); ?>
