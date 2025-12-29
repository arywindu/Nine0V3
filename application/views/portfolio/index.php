<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <meta name="description" content="<?= $meta_description ?>">
    <link rel="icon" type="image/png" href="<?= base_url('src/favIcon/favicon.jpg') ?>">
    <link href="https://fonts.cdnfonts.com/css/inter" rel="stylesheet">
    <link href="https://db.onlinewebfonts.com/c/0d37e976ab1e70a9e6a2b3659d180603?family=Square+721+Extended" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', Arial, sans-serif; 
            background: #F6D55C;
            color: #2d3748;
            overflow-x: hidden;
        }
        
        /* Header */
        .header {
            background: #F6D55C;
            padding: 20px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(45, 55, 72, 0.1);
        }
        
        .logo {
            font-family: 'Square 721 Extended', sans-serif;
            font-size: 2rem;
            font-weight: bold;
            color: #2d3748;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 40px;
        }
        
        .nav-menu a {
            color: #2d3748;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }
        
        .nav-menu a:hover, .nav-menu a.active {
            color: #F15A29;
        }
        
        /* Main Content */
        .main-container {
            display: flex;
            min-height: calc(100vh - 80px);
        }
        
        /* Left Sidebar - Portfolio List */
        .portfolio-sidebar {
            width: 320px;
            background: #F6D55C;
            padding: 40px 30px;
            border-right: 1px solid rgba(45, 55, 72, 0.1);
        }
        
        .breadcrumb {
            font-size: 12px;
            color: #666;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .portfolio-list {
            list-style: none;
        }
        
        .portfolio-item-link {
            display: block;
            margin-bottom: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            padding: 10px;
            border-radius: 5px;
        }
        
        .portfolio-item-link:hover, .portfolio-item-link.active {
            transform: translateX(5px);
            color: inherit;
            background: rgba(241, 90, 41, 0.1);
        }
        
        .portfolio-title {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .portfolio-meta {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Right Content - Portfolio Grid */
        .portfolio-content {
            flex: 1;
            padding: 40px;
            background: #F6D55C;
            overflow-y: auto;
        }
        
        .back-button {
            background: #F15A29;
            color: white;
            border: none;
            padding: 12px 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 30px;
            transition: all 0.3s ease;
        }
        
        .back-button:hover {
            background: #e14a1f;
            transform: translateY(-2px);
        }
        
        .portfolio-grid-view {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 25px;
            max-width: 1200px;
        }
        
        .portfolio-grid-item {
            position: relative;
            background: white;
            border-radius: 0;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            aspect-ratio: 4/3;
        }
        
        .portfolio-grid-item:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.25);
        }
        
        .portfolio-grid-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: all 0.3s ease;
        }
        
        .portfolio-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.75);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            opacity: 0;
            transition: all 0.4s ease;
            color: white;
            padding: 30px;
        }
        
        .portfolio-grid-item:hover .portfolio-overlay {
            opacity: 1;
        }
        
        .overlay-project {
            font-size: 13px;
            color: #F6D55C;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        .overlay-title {
            font-size: 28px;
            font-weight: bold;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
            line-height: 1.1;
            font-family: 'Square 721 Extended', sans-serif;
        }
        
        .overlay-client-label {
            font-size: 13px;
            color: #F6D55C;
            text-transform: uppercase;
            letter-spacing: 3px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        
        .overlay-client {
            font-size: 20px;
            font-weight: 600;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        
        .portfolio-detail {
            display: none;
        }
        
        .portfolio-detail.active {
            display: block;
        }
        
        .portfolio-detail-title {
            font-family: 'Square 721 Extended', sans-serif;
            font-size: 2.5rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        
        .portfolio-detail-meta {
            display: flex;
            gap: 30px;
            margin-bottom: 40px;
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .portfolio-images {
            margin-bottom: 40px;
        }
        
        .image-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .portfolio-image {
            background: white;
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            aspect-ratio: 4/3;
        }
        
        .portfolio-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        
        .portfolio-info {
            background: white;
            padding: 30px;
            border-radius: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .info-section {
            margin-bottom: 25px;
        }
        
        .info-title {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .info-content {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
        }
        
        .project-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }
        
        .detail-item {
            border-left: 3px solid #F15A29;
            padding-left: 15px;
        }
        
        .detail-label {
            font-size: 11px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
        }
        
        .project-url {
            color: #F15A29;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .project-url:hover {
            color: #e14a1f;
        }
        
        .default-content {
            display: block;
        }
        
        .default-content.hidden {
            display: none;
        }
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 20px;
                padding: 20px;
            }
            
            .nav-menu {
                gap: 20px;
            }
            
            .main-container {
                flex-direction: column;
            }
            
            .portfolio-sidebar {
                width: 100%;
                padding: 20px;
            }
            
            .portfolio-content {
                padding: 20px;
            }
            
            .portfolio-grid-view {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            .portfolio-grid-item {
                min-height: 250px;
            }
            
            .overlay-title {
                font-size: 20px;
            }
            
            .overlay-client {
                font-size: 16px;
            }
            
            .portfolio-detail-title {
                font-size: 1.8rem;
            }
            
            .portfolio-detail-meta {
                flex-direction: column;
                gap: 10px;
            }
            
            .portfolio-info {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Header with Navigation -->
    <header class="header">
        <div class="logo">NINE 0</div>
        <nav>
            <ul class="nav-menu">
                <li><a href="<?= base_url() ?>">ABOUT US</a></li>
                <li><a href="<?= base_url() ?>">SERVICES</a></li>
                <li><a href="<?= base_url('portfolio') ?>" class="active">PORTFOLIO</a></li>
                <li><a href="<?= base_url() ?>">CLIENTS</a></li>
                <li><a href="<?= base_url() ?>">CONTACT</a></li>
            </ul>
        </nav>
    </header>
    
    <!-- Main Container -->
    <div class="main-container">
        <!-- Left Sidebar - Portfolio List -->
        <aside class="portfolio-sidebar">
            <div class="breadcrumb">/ PORTFOLIO</div>
            
            <ul class="portfolio-list">
                <?php if (!empty($portfolios)): ?>
                    <?php foreach ($portfolios as $index => $portfolio): ?>
                        <li>
                            <a href="#" class="portfolio-item-link" onclick="handleSidebarClick(<?= $index ?>)" data-index="<?= $index ?>">
                                <div class="portfolio-title"><?= $portfolio->title ?></div>
                                <div class="portfolio-meta"><?= $portfolio->category ?> (<?= $portfolio->year ?>)</div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>
                        <div class="portfolio-title">NO PORTFOLIO</div>
                        <div class="portfolio-meta">COMING SOON</div>
                    </li>
                <?php endif; ?>
            </ul>
        </aside>
        
        <!-- Right Content - Portfolio Grid & Details -->
        <main class="portfolio-content">
            <!-- Portfolio Grid View (Default) -->
            <div class="default-content" id="grid-view">
                <div class="portfolio-grid-view">
                    <?php if (!empty($portfolios)): ?>
                        <?php foreach ($portfolios as $index => $portfolio): ?>
                            <?php 
                            $images = [];
                            if (isset($portfolio->images) && $portfolio->images) {
                                $images = json_decode($portfolio->images, true);
                            }
                            
                            $image_src = '';
                            if (!empty($images)) {
                                $image_src = base_url('uploads/' . $images[0]['image']);
                            } elseif ($portfolio->image) {
                                $image_src = base_url('uploads/' . $portfolio->image);
                            }
                            ?>
                            
                            <div class="portfolio-grid-item" onclick="showPortfolio(<?= $index ?>)">
                                <?php if ($image_src): ?>
                                    <img src="<?= $image_src ?>" alt="<?= $portfolio->title ?>">
                                <?php else: ?>
                                    <div style="width: 100%; height: 100%; background: #f0f0f0; display: flex; align-items: center; justify-content: center; color: #999; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">
                                        <?= $portfolio->title ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="portfolio-overlay">
                                    <div class="overlay-project">PROJECT</div>
                                    <div class="overlay-title"><?= $portfolio->title ?></div>
                                    <div class="overlay-client-label">CLIENT</div>
                                    <div class="overlay-client"><?= $portfolio->client ?: 'NINE 0 STUDIO' ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div style="grid-column: 1 / -1; text-align: center; padding: 100px 20px; color: #666;">
                            <h2 style="font-size: 2rem; margin-bottom: 20px; color: #2d3748;">No Portfolio Items</h2>
                            <p>Portfolio items will appear here once added.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Portfolio Details -->
            <?php if (!empty($portfolios)): ?>
                <?php foreach ($portfolios as $index => $portfolio): ?>
                    <div class="portfolio-detail" id="portfolio-<?= $index ?>">
                        <button onclick="showGridView()" class="back-button">
                            ← Back to Portfolio
                        </button>
                        
                        <h1 class="portfolio-detail-title"><?= $portfolio->title ?></h1>
                        
                        <div class="portfolio-detail-meta">
                            <span><?= $portfolio->category ?></span>
                            <?php if ($portfolio->client): ?>
                                <span><?= $portfolio->client ?></span>
                            <?php endif; ?>
                            <span><?= $portfolio->year ?></span>
                        </div>
                        
                        <?php 
                        $images = [];
                        if (isset($portfolio->images) && $portfolio->images) {
                            $images = json_decode($portfolio->images, true);
                        }
                        
                        if (!empty($images) || $portfolio->image): ?>
                            <div class="portfolio-images">
                                <div class="image-grid">
                                    <?php if (!empty($images)): ?>
                                        <?php foreach ($images as $img): ?>
                                            <div class="portfolio-image">
                                                <img src="<?= base_url('uploads/' . $img['image']) ?>" alt="<?= $portfolio->title ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php elseif ($portfolio->image): ?>
                                        <div class="portfolio-image">
                                            <img src="<?= base_url('uploads/' . $portfolio->image) ?>" alt="<?= $portfolio->title ?>">
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <div class="portfolio-info">
                            <div class="project-details">
                                <div class="detail-item">
                                    <div class="detail-label">Category</div>
                                    <div class="detail-value"><?= $portfolio->category ?></div>
                                </div>
                                
                                <?php if ($portfolio->client): ?>
                                    <div class="detail-item">
                                        <div class="detail-label">Client</div>
                                        <div class="detail-value"><?= $portfolio->client ?></div>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="detail-item">
                                    <div class="detail-label">Year</div>
                                    <div class="detail-value"><?= $portfolio->year ?></div>
                                </div>
                                
                                <?php if ($portfolio->url): ?>
                                    <div class="detail-item">
                                        <div class="detail-label">Website</div>
                                        <div class="detail-value">
                                            <a href="<?= $portfolio->url ?>" target="_blank" class="project-url">
                                                VISIT PROJECT →
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($portfolio->description): ?>
                                <div class="info-section">
                                    <h3 class="info-title">Project Description</h3>
                                    <div class="info-content">
                                        <?= nl2br($portfolio->description) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>
    </div>
    
    <script>
        function showPortfolio(index) {
            // Hide grid view
            document.getElementById('grid-view').style.display = 'none';
            
            // Hide all portfolio details
            const allDetails = document.querySelectorAll('.portfolio-detail');
            allDetails.forEach(detail => detail.classList.remove('active'));
            
            // Show selected portfolio
            document.getElementById('portfolio-' + index).classList.add('active');
            
            // Update active state in sidebar
            const allLinks = document.querySelectorAll('.portfolio-item-link');
            allLinks.forEach(link => link.classList.remove('active'));
            
            const activeLink = document.querySelector(`[data-index="${index}"]`);
            if (activeLink) {
                activeLink.classList.add('active');
            }
            
            // Scroll to top of content
            document.querySelector('.portfolio-content').scrollTop = 0;
        }
        
        function showGridView() {
            // Hide all portfolio details
            const allDetails = document.querySelectorAll('.portfolio-detail');
            allDetails.forEach(detail => detail.classList.remove('active'));
            
            // Show grid view
            document.getElementById('grid-view').style.display = 'block';
            
            // Remove active state from sidebar
            const allLinks = document.querySelectorAll('.portfolio-item-link');
            allLinks.forEach(link => link.classList.remove('active'));
            
            // Scroll to top of content
            document.querySelector('.portfolio-content').scrollTop = 0;
        }
        
        // Update sidebar click to also work with grid view
        function handleSidebarClick(index) {
            showPortfolio(index);
        }
    </script>
</body>
</html>
