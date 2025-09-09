<?php
include 'db.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $result = mysqli_query($conn, "SELECT slug FROM blogs WHERE id = $id LIMIT 1");
    $blog = mysqli_fetch_assoc($result);

    if ($blog && !empty($blog['slug'])) {
        // Redirect to title-based URL
        header("Location: blog/" . urlencode($blog['slug']));
        exit;
    } else {
        echo "Blog not found.";
        exit;
    }
} elseif (isset($_GET['title'])) {
    $slug = mysqli_real_escape_string($conn, $_GET['title']);
    $result = mysqli_query($conn, "SELECT * FROM blogs WHERE slug = '$slug' LIMIT 1");
    $blog = mysqli_fetch_assoc($result);

    if (!$blog) {
        echo "Blog not found.";
        exit;
    }
} else {
    echo "No blog specified.";
    exit;
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= htmlspecialchars($blog['meta_title'] ?: $blog['title']) ?> - Nirmal</title>
    <!-- Base URL -->
    <base href="/Group Nirmal/">
    <!-- Meta Tags -->
    <meta name="title" content="<?= htmlspecialchars($blog['meta_title'] ?: $blog['title']) ?>">
    <meta name="description" content="<?= htmlspecialchars($blog['meta_description']) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($blog['meta_keywords']) ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?= htmlspecialchars($blog['meta_title'] ?: $blog['title']) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($blog['meta_description']) ?>">
    <meta property="og:image" content="https://yourdomain.com/uploads/blogs/<?= htmlspecialchars($blog['image']) ?>">
    <meta property="og:url" content="https://yourdomain.com/blog.php?title=<?= urlencode($blog['slug']) ?>">
    <meta property="og:type" content="article">

    <!-- Article Structured Data Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "https://yourdomain.com/blog.php?title=<?= urlencode($blog['slug']) ?>"
            },
            "headline": "<?= htmlspecialchars($blog['meta_title'] ?: $blog['title']) ?>",
            "description": "<?= htmlspecialchars($blog['meta_description']) ?>",
            "image": "https://yourdomain.com/uploads/blogs/<?= htmlspecialchars($blog['image']) ?>",
            "author": {
                "@type": "Organization",
                "name": "Group Nirmal"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Group Nirmal",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://yourdomain.com/assets/images/logo/logo.png"
                }
            },
            "datePublished": "<?= date('c', strtotime($blog['created_at'])) ?>",
            "dateModified": "<?= date('c', strtotime($blog['updated_at'] ?? $blog['created_at'])) ?>"
        }
    </script>

    <!-- Favicon and Styles -->
    <link rel="shortcut icon" href="assets/images/logo/fav.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@latest/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/blog-internal-pages.css">

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
                <a href="/"><img src="assets/images/logo/logo.png" alt="Nirmal"></a>
            </div>
            <div class="line"></div>
            <div class="group-logo">
                <img src="assets/images/logo/group-logo.jpg" alt="Group Nirmal">
            </div>
            <div class="menu-btn">
                <button><img src="assets/images/svg/menu.svg" alt="icon"> <span>MENU</span></button>
            </div>
        </div>
        <div class="nav-right">
            <div class="social-icons">
                <a href="https://www.facebook.com/groupnirmal?mibextid=ZbWKwL" target="_blank"><img src="assets/images/svg/facebook.svg" alt="facebook"></a>
                <a href="https://www.instagram.com/group.nirmal?igsh=MWFxZ3BqZzgzamhibg==" target="_blank"><img src="assets/images/svg/instagram.svg" alt="instagram"></a>
                <a href="https://www.linkedin.com/company/nirmal-wires-private-limited/" target="_blank"><img src="assets/images/svg/linkedin.svg" alt="linkedin"></a>
                <a href="https://youtube.com/@groupnirmal?si=vw5R2dLVZcAu8S32" target="_blank"><img src="assets/images/svg/youtube.svg" alt="youtube"></a>
                <a href="https://x.com/NirmalWires" target="_blank"><img src="assets/images/svg/twitter.svg" alt="twitter"></a>
                <a href="catalogues.html"><img src="assets/images/svg/download.svg" alt="download"></a>
            </div>
            <a href="contact.html"><button>GET IN TOUCH</button></a>
        </div>
        <!-- Menu List -->
        <div class="nav-menu">
            <a href="/" class="menu">
                <img src="assets/images/menu-icon/menu-icon-01.png" alt="icon">
                <span>Home</span>
            </a>
            <a href="our-story.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-02.png" alt="icon">
                <span>Our Story</span>
            </a>
            <a href="products.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-03.png" alt="icon">
                <span>Products</span>
            </a>
            <a href="quality-assurance.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-04.png" alt="icon">
                <span>Quality Assurance</span>
            </a>
            <a href="trading.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-11.png" alt="icon">
                <span>Trading</span>
            </a>
            <a href="our-presence.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-06.png" alt="icon">
                <span>Our Presence</span>
            </a>
            <a href="csr.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-10.png" alt="icon">
                <span>CSR</span>
            </a>
            <a href="career.php" class="menu">
                <img src="assets/images/menu-icon/menu-icon-07.png" alt="icon">
                <span>Careers</span>
            </a>
            <a href="view-blog.php" class="menu">
                <img src="assets/images/menu-icon/blog.png" alt="icon">
                <span>Blog</span>
            </a>
            <a href="contact.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-08.png" alt="icon">
                <span>Contact Us</span>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->
    <!-- Banner Start -->
    <section class="banner">
        <img src="uploads/blogs/<?= htmlspecialchars($blog['image']) ?>" alt="banner">
    </section>
    <!-- Banner End -->

    <!-- Blog Content Start -->
    <section class="blog-content">
        <h1 data-aos="fade" data-aos-duration="1000"><?= htmlspecialchars($blog['title']) ?></h1>

        <?php
        // Convert content into paragraphs and auto-format it
        $content = nl2br($blog['content']);
        $lines = explode('<br />', $content);
        foreach ($lines as $line) {
            $line = trim($line);
            if (strlen($line) > 0) {
                // Optional: Detect H3 with markdown-style ## or use a field in DB if you separate headings
                if (str_starts_with($line, '##')) {
                    echo '<h3 data-aos="fade" data-aos-duration="1000">' . htmlspecialchars(ltrim($line, '# ')) . '</h3>';
                } else {
                    echo '<p data-aos="fade" data-aos-duration="1000">' . $line . '</p>';
                }
            }
        }
        ?>
    </section>
    <!-- Blog Content End -->
    <!-- Social icon Start -->
    <div class="social-row" data-aos="fade" data-aos-duration="1000">
        <a href="https://www.facebook.com/groupnirmal?mibextid=ZbWKwL" target="_blank"><img src="assets/images/svg/facebook.svg" alt="facebook"></a>
        <a href="https://www.instagram.com/group.nirmal?igsh=MWFxZ3BqZzgzamhibg==" target="_blank"><img src="assets/images/svg/instagram.svg" alt="instagram"></a>
        <a href="https://www.linkedin.com/company/nirmal-wires-private-limited/" target="_blank"><img src="assets/images/svg/linkedin.svg" alt="linkedin"></a>
    </div>
    <!-- Social icon End -->

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
            <img src="assets/images/svg/whatsapp.svg" alt="WhatsApp">
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

    <!-- JS Link -->
    <script src="assets/js/script.js"></script>

</body>

</html>