<?php
include 'db.php';

// Fetch all careers
$careers = mysqli_query($conn, "SELECT * FROM careers ORDER BY created_at DESC");
$total = mysqli_num_rows($careers);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Careers at Group Nirmal | Join Our Team</title>
    <link rel="shortcut icon" href="assets/images/logo/fav.png" type="image/x-icon">
    <!-- Link to Canonical -->
    <link rel="canonical" href="https://groupnirmal.com/career.php">
    <!-- Link Meta Title -->
    <meta name="title" content="Careers at Group Nirmal | Join Our Team">
    <!-- Link Meta Description -->
    <meta name="description" content="Explore job opportunities and build your career with a leading steel manufacturing company. Apply now.">
    <!-- Bootstrap CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link to Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Link to AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Link to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <!-- Link to Swipper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.css" />
    <!-- CSS Link -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/career.css">

    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c, l, a, r, i, t, y) {
            c[a] = c[a] || function() {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "sg9jh6hqln");
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PRJG7786XG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-PRJG7786XG');
    </script>
</head>

<body>

    <!-- Navbar Start -->
    <nav>
        <div class="nav-left">
            <div class="logo">
                <a href="/"><img src="assets/images/logo/logo.png" alt="Nirmal" loading="lazy" width="50" height="50"></a>
            </div>
            <div class="line"></div>
            <div class="group-logo">
                <img src="assets/images/logo/group-logo.jpg" alt="Group Nirmal" loading="lazy" width="50" height="50">
            </div>
            <div class="menu-btn">
                <button><img src="assets/images/svg/menu.svg" alt="icon" loading="lazy" width="20" height="20"> <span>MENU</span></button>
            </div>
        </div>
        <div class="nav-right">
            <div class="social-icons">
                <a href="https://www.facebook.com/groupnirmal?mibextid=ZbWKwL" target="_blank"><img
                        src="assets/images/svg/facebook.svg" alt="facebook" loading="lazy" width="20" height="20"></a>
                <a href="https://www.instagram.com/group.nirmal?igsh=MWFxZ3BqZzgzamhibg==" target="_blank"><img
                        src="assets/images/svg/instagram.svg" alt="instagram" loading="lazy" width="20" height="20"></a>
                <a href="https://www.linkedin.com/company/nirmal-wires-private-limited/" target="_blank"><img
                        src="assets/images/svg/linkedin.svg" alt="linkedin" loading="lazy" width="20" height="20"></a>
                <a href="https://youtube.com/@groupnirmal?si=vw5R2dLVZcAu8S32" target="_blank"><img
                        src="assets/images/svg/youtube.svg" alt="youtube" loading="lazy" width="20" height="20"></a>
                <a href="https://x.com/NirmalWires" target="_blank"><img src="assets/images/svg/twitter.svg"
                        alt="twitter" loading="lazy" width="20" height="20"></a>
                <a href="catalogues.html"><img src="assets/images/svg/download.svg" alt="download" loading="lazy" width="20" height="20"></a>
            </div>
            <a href="contact.html"><button>GET IN TOUCH</button></a>
        </div>
        <!-- Menu List -->
        <div class="nav-menu">
            <a href="/" class="menu">
                <img src="assets/images/menu-icon/menu-icon-01.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Home</span>
            </a>
            <a href="our-story.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-02.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Our Story</span>
            </a>
            <a href="products.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-03.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Products</span>
            </a>
            <a href="quality-assurance.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-04.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Quality Assurance</span>
            </a>
            <a href="trading.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-11.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Trading</span>
            </a>
            <a href="our-presence.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-06.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Our Presence</span>
            </a>
            <a href="csr.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-10.png" alt="icon" loading="lazy" width="40" height="40">
                <span>CSR</span>
            </a>
            <a href="career.php" class="menu">
                <img src="assets/images/menu-icon/menu-icon-07.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Careers</span>
            </a>
            <a href="view-blog.php" class="menu">
                <img src="assets/images/menu-icon/blog.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Blog</span>
            </a>
            <a href="contact.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-08.png" alt="icon" loading="lazy" width="40" height="40">
                <span>Contact Us</span>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Banner Start -->
    <section class="banner">
        <img src="assets/images/career-banner.webp" alt="banner" loading="lazy" width="800" height="400">
        <div class="banner-content">
            <h1 data-aos="fade-up" data-aos-duration="1000">CAREERS</h1>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Career Job Container Start -->
    <div class="jobs-container">
        <h2 class="jobs-title">Open - Positions (<?= $total ?>)</h2>

        <div class="jobs-header">
            <div>Role</div>
            <div>Location</div>
            <div></div>
        </div>

        <?php while ($job = mysqli_fetch_assoc($careers)): ?>
            <div class="job-row">
                <div>
                    <div class="job-role-title"><?= htmlspecialchars($job['designation']) ?></div>
                    <div class="job-role-details">Experience – <?= htmlspecialchars($job['experience']) ?> years</div>
                    <div class="job-posted">
                        <?php
                        $days = floor((time() - strtotime($job['created_at'])) / 86400);
                        echo 'Posted ' . ($days == 0 ? 'today' : $days . ' day' . ($days > 1 ? 's' : '') . ' ago');
                        ?>
                    </div>
                </div>
                <div><?= htmlspecialchars($job['location']) ?></div>
                <div>
                    <a href="view-career.php?id=<?= $job['id'] ?>">
                        <button class="job-button">Get job insights</button>
                    </a>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
    <!-- Career Job Container End -->

    <!-- Web Footer Start -->
    <footer class="web-footer">
        <div class="foot-content-row">
            <div class="foot-content-box">
                <img class="img-fluid" src="assets/images/footer-logo.png" alt="Nirmal" loading="lazy" width="170" height="40">
            </div>
            <div class="foot-content-box">
                <span>QUICK LINKS</span>
                <a href="/">Home</a>
                <a href="our-story.html">Our Story</a>
                <a href="quality-assurance.html">Quality Assurance</a>
                <a href="our-presence.html">Our Presence</a>
                <a href="csr.html">CSR</a>
                <a href="view-blog.php">Our Blogs</a>
                <a href="catalogues.html">Catalogues</a>
                <a href="sitemap.html">Sitemap</a>
                <a href="sitemap.xml" target="_blank">XML Sitemap</a>
            </div>
            <div class="foot-content-box">
                <span>PRODUCTS</span>
                <a href="products.html">Products By Type</a>
                <a href="products.html">Products By Industry</a>
                <a href="trading.html">Trading</a>
            </div>
            <div class="foot-content-box">
                <span>CONTACT US</span>
                <a href="contact.html">Corporate Office</a>
                <a href="contact.html">Manufacturing Units</a>
                <a href="career.php">Careers</a>
                <a href="our-presence.html">Media</a>
            </div>
            <div class="foot-content-box">
                <span>Toll Free No. 1800 309 3876</span>
                <div class="foot-social-icons">
                    <a href="https://www.facebook.com/groupnirmal?mibextid=ZbWKwL" target="_blank">
                        <img class="img-fluid" src="assets/images/svg/facebook.svg" alt="Facebook" loading="lazy" width="40" height="40" />
                    </a>
                    <a href="https://www.instagram.com/group.nirmal?igsh=MWFxZ3BqZzgzamhibg==" target="_blank">
                        <img class="img-fluid" src="assets/images/svg/instagram.svg" alt="Instagram" loading="lazy" width="40" height="40" />
                    </a>
                    <a href="https://www.linkedin.com/company/nirmal-wires-private-limited/" target="_blank">
                        <img class="img-fluid" src="assets/images/svg/linkedin.svg" alt="Linkedin" loading="lazy" width="40" height="40" />
                    </a>
                    <a href="https://youtube.com/@groupnirmal?si=vw5R2dLVZcAu8S32" target="_blank">
                        <img class="img-fluid" src="assets/images/svg/youtube.svg" alt="Youtube" loading="lazy" width="40" height="40" />
                    </a>
                    <a href="https://x.com/NirmalWires" target="_blank">
                        <img class="img-fluid" src="assets/images/svg/twitter.svg" alt="Twitter" loading="lazy" width="40" height="40" />
                    </a>
                </div>
                <div class="fifty-year-logo">
                    <img class="img-fluid ms-auto" src="assets/images/50-years-2.png" alt="50 years logo" loading="lazy" width="75" height="75">
                </div>
            </div>
        </div>
        <div class="foot-copyright">
            <p>Copyright &copy; 2025 | Group Nirmal</p>
        </div>
    </footer>
    <!-- Web Footer End -->

    <!-- Mobile Footer Start -->
    <footer class="mobile-footer">
        <div class="foot-logo">
            <img class="img-fluid" src="assets/images/footer-logo.png" alt="Nirmal" loading="lazy" width="170" height="40">
        </div>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <div class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#foot-ql" aria-expanded="false" aria-controls="foot-ql">
                        QUICK LINKS
                    </button>
                </div>
                <div id="foot-ql" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="/">Home</a>
                        <a href="our-story.html">Our Story</a>
                        <a href="quality-assurance.html">Quality Assurance</a>
                        <a href="our-presence.html">Our Presence</a>
                        <a href="csr.html">CSR</a>
                        <a href="view-blog.php">Our Blogs</a>
                        <a href="catalogues.html">Catalogues</a>
                        <a href="sitemap.html">Sitemap</a>
                        <a href="sitemap.xml" target="_blank">XML Sitemap</a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#foot-products" aria-expanded="false" aria-controls="foot-products">
                        PRODUCTS
                    </button>
                </div>
                <div id="foot-products" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="products.html">Products By Type</a>
                        <a href="products.html">Products By Industry</a>
                        <a href="trading.html">Trading</a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#foot-contact" aria-expanded="false" aria-controls="foot-contact">
                        CONTACT US
                    </button>
                </div>
                <div id="foot-contact" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="contact.html">Corporate Office</a>
                        <a href="contact.html">Manufacturing Units</a>
                        <a href="career.php">Careers</a>
                        <a href="our-presence.html">Media</a>
                        <span>Toll Free No. 1800 309 3876</span>
                        <div class="foot-social-icons">
                            <a href="https://www.facebook.com/groupnirmal?mibextid=ZbWKwL" target="_blank">
                                <img class="img-fluid" src="assets/images/svg/facebook.svg" alt="Facebook" loading="lazy" width="40" height="40" />
                            </a>
                            <a href="https://www.instagram.com/group.nirmal?igsh=MWFxZ3BqZzgzamhibg==" target="_blank">
                                <img class="img-fluid" src="assets/images/svg/instagram.svg" alt="Instagram" loading="lazy" width="40" height="40" />
                            </a>
                            <a href="https://www.linkedin.com/company/nirmal-wires-private-limited/" target="_blank">
                                <img class="img-fluid" src="assets/images/svg/linkedin.svg" alt="Linkedin" loading="lazy" width="40" height="40" />
                            </a>
                            <a href="https://youtube.com/@groupnirmal?si=vw5R2dLVZcAu8S32" target="_blank">
                                <img class="img-fluid" src="assets/images/svg/youtube.svg" alt="Youtube" loading="lazy" width="40" height="40" />
                            </a>
                            <a href="https://x.com/NirmalWires" target="_blank">
                                <img class="img-fluid" src="assets/images/svg/twitter.svg" alt="Twitter" loading="lazy" width="40" height="40" />
                            </a>
                        </div>
                        <div class="fifty-year-logo">
                            <img class="img-fluid ms-auto" src="assets/images/50-years-2.png" alt="50 years logo" loading="lazy" width="75" height="75">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="foot-copyright">
            <p>Copyright &copy; 2025 | Group Nirmal</p>
        </div>
    </footer>
    <!-- Mobile Footer End -->

    <!-- WhatsApp Icon Start -->
    <section class="wp">
        <a href="https://wa.me/18003093876" target="_blank">
            <img src="assets/images/svg/whatsapp.svg" alt="WhatsApp" loading="lazy" width="50" height="50">
        </a>
    </section>
    <!-- WhatsApp Icon End -->


    <!-- -------------------------------------------------------------------------------------------------------------------------------- -->

    <!-- Bootstrap JS Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.js"></script>

    <!-- Lenis Scroll Link -->
    <script src="https://unpkg.com/lenis@1.1.16/dist/lenis.min.js"></script>
    <script>
        const lenis = new Lenis({
            duration: 0.5, // Adjust the duration for smooth scrolling
            easing: (t) => t * (2 - t),
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    </script>

    <!-- AOS Animation JS Link -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Apps Card Hover Functionality -->
    <script>
        let appsCard = document.querySelectorAll('.apps-card');
        let blueLayer = document.querySelectorAll('.blue-layer');
        appsCard.forEach((card, index) => {
            card.addEventListener('mouseenter', () => {
                blueLayer[index].style.bottom = '0';
            })
            card.addEventListener('mouseleave', () => {
                blueLayer[index].style.bottom = '-100%';
            })
        })
    </script>

    <!-- JS Link -->
    <script src="assets/js/script.js"></script>
    <script>
        // Select all divs that directly contain a .job-button
        document.querySelectorAll('div > .job-button').forEach(button => {
            button.parentElement.addEventListener('click', () => {
                window.location.href = 'career2.html';
            });
        });
    </script>

</body>

</html>