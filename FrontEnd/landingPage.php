<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Discover the Louvre's collections and reserve your guided museum experience.">
    <title>Louvre Museum | Guided Tours</title>
    <link rel="stylesheet" href="landing.css?v=9">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="landingPage.php" aria-label="Louvre Museum home">
            <span class="brand-mark">M</span>
            <span class="brand-name">LOUVRE <em>PARIS</em></span>
        </a>

        <nav class="main-nav" aria-label="Main navigation">
            <a class="active" href="#home">Home</a>
            <a href="#experience">The experience</a>
            <a href="#collections">Collections</a>
            <a href="#visit">Plan your visit</a>
        </nav>

        <div class="header-actions">
            <a class="login-link" href="../BackEnd/pages/login.php">Log in</a>
            <a class="outline-button" href="../BackEnd/pages/signup.php">Create account</a>
        </div>
    </header>

    <main>
        <section id="home" class="hero">
            <div class="hero-copy">
                <p class="eyebrow">Welcome to the Louvre</p>
                <h1>Where history<br><span>becomes art.</span></h1>
                <p class="hero-text">
                    Discover masterpieces, royal treasures, and stories that
                    shaped civilization. Reserve a guided tour through the
                    world&apos;s most celebrated museum.
                </p>
                <div class="hero-actions">
                    <a class="primary-button" href="../BackEnd/pages/signup.php">Reserve your experience <span>→</span></a>
                    <a class="text-button" href="#experience">Explore the museum <span>↓</span></a>
                </div>
                <div class="hero-note">
                    <span class="note-line"></span>
                    <span>Paris · Open every day except Tuesday</span>
                </div>
            </div>
        </section>

        <section id="experience" class="intro-section">
            <div class="section-heading">
                <p class="eyebrow">The Louvre experience</p>
                <h2>Eight centuries.<br><em>One extraordinary story.</em></h2>
            </div>
            <div class="intro-copy">
                <p>
                    Walk through the former royal palace and encounter
                    artworks from ancient civilizations to the present day.
                    Our guides reveal the details behind the masterpieces.
                </p>
                <a class="underlined-link" href="#collections">Discover our collections <span>↗</span></a>
            </div>
        </section>

        <section id="collections" class="collection-section">
            <div class="section-topline">
                <div>
                    <p class="eyebrow">Explore the collections</p>
                    <h2>Choose your journey.</h2>
                </div>
                <a class="underlined-link" href="user_page.php">View all tours <span>↗</span></a>
            </div>
            <div class="collection-grid">
                <article class="collection-card card-ancient">
                    <img class="card-image" src="images/808x539_cmsv2_950880d4-2c99-5dcc-90eb-0977f3cc2c2e-9578563.avif" alt="Ornate Louvre gallery ceiling">
                    <span class="card-index">01</span>
                    <div class="card-content"><p>Architecture · 90 min</p><h3>The grand<br>galleries</h3><a href="../BackEnd/pages/signup.php">Book a tour <span>→</span></a></div>
                </article>
                <article class="collection-card card-modern">
                    <img class="card-image" src="images/images.jpg" alt="Visitors attending a guided museum tour">
                    <span class="card-index">02</span>
                    <div class="card-content"><p>Guided visit · 75 min</p><h3>Stories behind<br>the art</h3><a href="../BackEnd/pages/signup.php">Book a tour <span>→</span></a></div>
                </article>
                <article class="collection-card card-royal">
                    <img class="card-image" src="images/20240810100953494.jpg" alt="Louvre palace and courtyard in Paris">
                    <span class="card-index">03</span>
                    <div class="card-content"><p>Paris · 60 min</p><h3>The palace<br>in focus</h3><a href="../BackEnd/pages/signup.php">Book a tour <span>→</span></a></div>
                </article>
            </div>
        </section>

        <section id="visit" class="visit-section">
            <div>
                <p class="eyebrow">Your Louvre story starts here</p>
                <h2>Meet the works<br><em>you know by heart.</em></h2>
            </div>
            <div class="visit-card">
                <p>Ready to visit Paris?</p>
                <a class="primary-button" href="../BackEnd/pages/signup.php">Plan your visit <span>→</span></a>
                <small>Reserve your guided Louvre experience.</small>
            </div>
        </section>

        <section class="palace-section">
            <div class="palace-image">
                <img src="images/last3.jpg" alt="The Louvre palace and courtyard in Paris">
            </div>
            <div class="palace-copy">
                <p class="eyebrow">The palace · Paris</p>
                <h2>A living monument<br><em>to human imagination.</em></h2>
                <p>From royal residence to global cultural landmark, the Louvre is a journey through time itself.</p>
                <a class="underlined-link" href="../BackEnd/pages/signup.php">Reserve your place in history <span>↗</span></a>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="footer-main">
            <a class="brand footer-brand" href="landingPage.php">
                <span class="brand-mark">M</span>
                <span class="brand-name">LOUVRE <em>PARIS</em></span>
            </a>
            <p class="footer-motto">Where history<br><em>becomes art.</em></p>
        </div>
        <div class="footer-links">
            <div>
                <p class="footer-heading">Explore</p>
                <a href="#experience">The experience</a>
                <a href="#collections">Collections</a>
                <a href="#visit">Plan your visit</a>
            </div>
            <div>
                <p class="footer-heading">Visit</p>
                <span>Rue de Rivoli</span>
                <span>75001 Paris, France</span>
                <span>Open every day except Tuesday</span>
            </div>
            <div>
                <p class="footer-heading">Your account</p>
                <a href="../BackEnd/pages/login.php">Log in</a>
                <a href="../BackEnd/pages/signup.php">Create account</a>
            </div>
        </div>
        <div class="footer-bottom">
            <span>© 2026 Louvre Museum</span>
            <span>Stories preserved · Wonder discovered</span>
            <span>Paris, France</span>
        </div>
    </footer>
    <script>
        const siteHeader = document.querySelector('.site-header');

        const updateHeaderOnScroll = () => {
            siteHeader.classList.toggle('is-scrolled', window.scrollY > 24);
        };

        updateHeaderOnScroll();
        window.addEventListener('scroll', updateHeaderOnScroll, { passive: true });
    </script>
</body>
</html>