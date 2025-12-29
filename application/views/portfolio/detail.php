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
            line-height: 1.6;
        }
        
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .back-link {
            display: inline-block;
            color: #2d3748;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: #F15A29;
        }
        
        .portfolio-header {
            margin-bottom: 40px;
        }
        
        .portfolio-title {
            font-family: 'Square 721 Extended', sans-serif;
            font-size: 3rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 20px;
        }
        
        .portfolio-meta {
            display: flex;
            gap: 30px;
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
        }
        
        .portfolio-image img {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .portfolio-info {
            background: white;
            padding: 40px;
            border-radius: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }
        
        .info-section {
            margin-bottom: 30px;
        }
        
        .info-title {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .info-content {
            font-size: 16px;
            color: #666;
            line-height: 1.8;
        }
        
        .project-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 30px;
            margin-bottom: 30px;
        }
        
        .detail-item {
            border-left: 3px solid #F15A29;
            padding-left: 15px;
        }
        
        .detail-label {
            font-size: 12px;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .detail-value {
            font-size: 16px;
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
        
        @media (max-width: 768px) {
            .portfolio-title {
                font-size: 2rem;
            }
            
            .portfolio-meta {
                flex-direction: column;
                gap: 10px;
            }
            
            .portfolio-info {
                padding: 20px;
            }
            
            .project-details {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="detail-container">
        <a href="<?= base_url('portfolio') ?>" class="back-link">← Back to Portfolio</a>
        
        <div class="portfolio-header">
            <h1 class="portfolio-title"><?= strtoupper($portfolio->title) ?></h1>
            <div class="portfolio-meta">
                <span><?= $portfolio->category ?></span>
                <span><?= $portfolio->client ?></span>
                <span><?= $portfolio->year ?></span>
            </div>
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
                                Visit Project →
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
</body>
</html>
