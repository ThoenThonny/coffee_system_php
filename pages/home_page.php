<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee House · dashboard</title>
    <!-- Bootstrap 5 + Font Awesome 6 (cozy café style) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f3ede5;  /* warm background like old paper */
            font-family: 'Segoe UI', Roboto, system-ui, sans-serif;
        }
        .coffee-card {
            background: #fffcf7;
            border: 1px solid #dbbc9e;
            border-radius: 2rem 2rem 2rem 2rem;
            box-shadow: 0 20px 30px -10px rgba(110, 70, 40, 0.2);
            transition: transform 0.2s ease;
        }
        .coffee-card:hover {
            transform: scale(1.01);
        }
        .coffee-title {
            font-size: 5rem;
            font-weight: 800;
            line-height: 1;
            color: #4e3520;      /* dark roasted brown */
            text-shadow: 2px 2px 0 #e9dacb;
            letter-spacing: -0.02em;
        }
        .coffee-subtitle {
            font-size: 2rem;
            font-weight: 300;
            color: #946b42;
            font-style: italic;
            border-bottom: 2px dashed #e1c6ad;
            padding-bottom: 1rem;
            margin-top: 0.5rem;
        }
        .tagline-block {
            font-size: 1.2rem;
            color: #3e2e21;
            background: #fef6ec;
            padding: 1.2rem;
            border-radius: 1.5rem;
            height: 100%;
            border-left: 6px solid #b48b65;
        }
        .tagline-block i {
            color: #aa7a50;
            width: 2rem;
        }
        .tagline-block p {
            margin-bottom: 0.3rem;
        }
        .dashboard-header {
            color: #4f3a28;
            border-left: 8px solid #b48b65;
            padding-left: 1.2rem;
            margin-top: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="container py-4 py-lg-5">
        <!-- === HERO SECTION – exactly from the photo (cozy stacked text) === -->
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <div class="coffee-card p-4 p-md-5">
                    <!-- "Coffee" and "House" as two distinct lines, big & bold -->
                    <div class="text-center stacked-house">
                        <div class="coffee-title">Coffee</div>
                        <div class="coffee-title" style="margin-top: -0.5rem;">House</div>
                        <div class="coffee-subtitle mt-2">The right place to have good rest!</div>
                    </div>

                    <!-- the two descriptive blocks (exact lines from image, with spaces) -->
                    <div class="row g-4 mt-3">
                        <!-- left block: satisfaction & desire -->
                        <div class="col-md-6">
                            <div class="tagline-block">
                                <i class="fas fa-mug-hot fa-fw mb-2"></i>
                                <p class="fw-semibold mb-1">The feeling of satisfaction and</p>
                                <p class="fw-semibold mb-1">the desire to come back again</p>
                                <p class="fw-semibold mb-0">won't leave you!</p>
                                <div class="mt-2 text-secondary"><small><i class="far fa-smile"></i> every visit</small></div>
                            </div>
                        </div>
                        <!-- right block: exquisite cuisine & interior -->
                        <div class="col-md-6">
                            <div class="tagline-block">
                                <i class="fas fa-utensils fa-fw mb-2"></i>
                                <p class="fw-semibold mb-1">Only here you will meet the</p>
                                <p class="fw-semibold mb-1">combination of exquisite cuisine,</p>
                                <p class="fw-semibold mb-0">pleasant interior and great service!</p>
                                <div class="mt-2 text-secondary"><small><i class="far fa-star"></i> signature experience</small></div>
                            </div>
                        </div>
                    </div>

                    <!-- tiny decorative coffee beans (optional vibe) -->
                    <div class="row mt-4 text-center d-none d-md-flex">
                        <div class="col">
                            <i class="fas fa-circle" style="color: #d9b48f; font-size: 0.5rem;"></i>
                            <i class="fas fa-circle mx-2" style="color: #b4824e; font-size: 0.6rem;"></i>
                            <i class="fas fa-circle" style="color: #7b583b; font-size: 0.5rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</html>