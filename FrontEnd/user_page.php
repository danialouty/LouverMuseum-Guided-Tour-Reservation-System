<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reserve a guided tour and manage your Louvre reservations.">
    <title>My Louvre Experience</title>
    <link rel="stylesheet" href="user.css?v=1">
</head>
<body>
    <header class="site-header">
        <a class="brand" href="landingPage.php" aria-label="Louvre Museum home">
            <span class="brand-mark">M</span>
            <span class="brand-name">LOUVRE <em>PARIS</em></span>
        </a>

        <nav class="main-nav" aria-label="User navigation">
            <a class="active" href="#tours">Book a tour</a>
            <a href="#availability">Availability</a>
            <a href="#reservations">My reservations</a>
        </nav>

        <div class="header-actions">
            <span class="welcome">Welcome, Visitor</span>
            <a class="outline-button" href="../BackEnd/pages/login.php">Log out</a>
        </div>
    </header>

    <main>
        <section class="welcome-section">
            <div>
                <p class="eyebrow">Your Louvre journey</p>
                <h1>Discover something<br><em>extraordinary.</em></h1>
                <p class="intro">Choose a guided experience, find a suitable time, and reserve your place among the world's masterpieces.</p>
            </div>
            <div class="visit-summary">
                <span class="summary-number">02</span>
                <span class="summary-label">Upcoming<br>reservations</span>
            </div>
        </section>

        <section class="content-section" id="tours">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Curated experiences</p>
                    <h2>Reserve a guided tour</h2>
                </div>
                <p class="section-note">Small groups. Unforgettable stories.</p>
            </div>

            <div class="tour-grid">
                <article class="tour-card">
                    <div class="tour-image image-interior">
                        <span class="tour-tag">Most popular</span>
                    </div>
                    <div class="tour-content">
                        <p class="tour-duration">90 MINUTES · ENGLISH</p>
                        <h3>The Louvre Essentials</h3>
                        <p>A first encounter with the museum's most celebrated masterpieces, from the Mona Lisa to the Venus de Milo.</p>
                        <div class="tour-meta">
                            <span>From 18€</span>
                            <a href="#availability">View times <span>→</span></a>
                        </div>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image image-collection">
                        <span class="tour-tag">New</span>
                    </div>
                    <div class="tour-content">
                        <p class="tour-duration">2 HOURS · ENGLISH</p>
                        <h3>Stories of the Masters</h3>
                        <p>Step into the world of Renaissance painters and discover the stories hidden behind their most iconic works.</p>
                        <div class="tour-meta">
                            <span>From 24€</span>
                            <a href="#availability">View times <span>→</span></a>
                        </div>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image image-palace">
                        <span class="tour-tag">Architecture</span>
                    </div>
                    <div class="tour-content">
                        <p class="tour-duration">75 MINUTES · ENGLISH</p>
                        <h3>Palace &amp; Courtyards</h3>
                        <p>Walk through royal courtyards and grand galleries while uncovering the Louvre's extraordinary history.</p>
                        <div class="tour-meta">
                            <span>From 16€</span>
                            <a href="#availability">View times <span>→</span></a>
                        </div>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image image-welcome">
                        <span class="tour-tag">Introduction</span>
                    </div>
                    <div class="tour-content">
                        <p class="tour-duration">60 MINUTES · ENGLISH</p>
                        <h3>Welcome to the Louvre</h3>
                        <p>Begin your Louvre journey with a welcoming introduction to its history, highlights, and unforgettable masterpieces.</p>
                        <div class="tour-meta">
                            <span>From 14€</span>
                            <a href="#availability">View times <span>→</span></a>
                        </div>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image image-egyptian">
                        <span class="tour-tag">Ancient Egypt</span>
                    </div>
                    <div class="tour-content">
                        <p class="tour-duration">90 MINUTES · ENGLISH</p>
                        <h3>Louvre Egyptian Side</h3>
                        <p>Explore ancient Egyptian treasures and uncover the stories, beliefs, and artistry preserved in the Louvre.</p>
                        <div class="tour-meta">
                            <span>From 20€</span>
                            <a href="#availability">View times <span>→</span></a>
                        </div>
                    </div>
                </article>

                <article class="tour-card">
                    <div class="tour-image image-art">
                        <span class="tour-tag">Art &amp; Culture</span>
                    </div>
                    <div class="tour-content">
                        <p class="tour-duration">90 MINUTES · ENGLISH</p>
                        <h3>Art Tour</h3>
                        <p>Discover the Louvre's artistic treasures and learn how remarkable works shaped the history of art.</p>
                        <div class="tour-meta">
                            <span>From 22€</span>
                            <a href="#availability">View times <span>→</span></a>
                        </div>
                    </div>
                </article>
            </div>
        </section>

        <section class="booking-layout" id="availability">
            <div class="availability-panel">
                <div class="section-heading compact">
                    <div>
                        <p class="eyebrow">Choose your moment</p>
                        <h2>Available time slots</h2>
                    </div>
                    <label class="date-picker">
                        <span>Date</span>
                        <input type="date" value="2026-10-28">
                    </label>
                </div>

                <div class="slot-list">
                    <label class="slot-card selected">
                        <input type="radio" name="time-slot" checked>
                        <span class="slot-time">10:00 <small>AM</small></span>
                        <span class="slot-details"><strong>The Louvre Essentials</strong><small>English · 90 minutes</small></span>
                        <span class="slot-capacity available">12 places left</span>
                    </label>
                    <label class="slot-card">
                        <input type="radio" name="time-slot">
                        <span class="slot-time">12:30 <small>PM</small></span>
                        <span class="slot-details"><strong>Stories of the Masters</strong><small>English · 2 hours</small></span>
                        <span class="slot-capacity available">7 places left</span>
                    </label>
                    <label class="slot-card">
                        <input type="radio" name="time-slot">
                        <span class="slot-time">03:00 <small>PM</small></span>
                        <span class="slot-details"><strong>Palace &amp; Courtyards</strong><small>English · 75 minutes</small></span>
                        <span class="slot-capacity limited">2 places left</span>
                    </label>
                    <label class="slot-card disabled">
                        <input type="radio" name="time-slot" disabled>
                        <span class="slot-time">05:00 <small>PM</small></span>
                        <span class="slot-details"><strong>The Louvre Essentials</strong><small>English · 90 minutes</small></span>
                        <span class="slot-capacity full">Fully booked</span>
                    </label>
                </div>
            </div>

            <form class="reservation-form" action="#" method="post">
                <p class="eyebrow">Complete your booking</p>
                <h2>Reserve your place</h2>
                <div class="selected-tour">
                    <span class="mini-label">Selected experience</span>
                    <strong>The Louvre Essentials</strong>
                    <span>Wednesday, October 28 · 10:00 AM</span>
                </div>
                <label for="note">Add a note <small>Optional</small></label>
                <textarea id="note" name="note" rows="4" placeholder="Tell us anything we should know..."></textarea>
                <button type="submit">Submit reservation <span>→</span></button>
                <p class="form-hint">Your reservation will be pending until confirmed by our team.</p>
            </form>
        </section>

        <section class="reservations-section" id="reservations">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Your journey</p>
                    <h2>My reservations</h2>
                </div>
                <span class="reservation-count">2 reservations</span>
            </div>

            <div class="reservation-list">
                <article class="reservation-card">
                    <div class="reservation-date"><strong>28</strong><span>OCT<br>2026</span></div>
                    <div class="reservation-info">
                        <span class="tour-duration">10:00 AM · ENGLISH</span>
                        <h3>The Louvre Essentials</h3>
                        <p>90 minutes · 1 visitor</p>
                    </div>
                    <span class="status confirmed">Confirmed</span>
                    <button class="cancel-button" type="button">Cancel</button>
                </article>
                <article class="reservation-card">
                    <div class="reservation-date"><strong>04</strong><span>NOV<br>2026</span></div>
                    <div class="reservation-info">
                        <span class="tour-duration">12:30 PM · ENGLISH</span>
                        <h3>Stories of the Masters</h3>
                        <p>2 hours · 1 visitor</p>
                    </div>
                    <span class="status pending">Pending</span>
                    <button class="cancel-button" type="button">Cancel</button>
                </article>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <span>© 2026 Louvre Museum</span>
        <span>Stories preserved · Wonder discovered</span>
        <a href="landingPage.php">Back to Louvre home →</a>
    </footer>
</body>
</html>
