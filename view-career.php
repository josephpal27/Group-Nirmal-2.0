<?php
include 'db.php';

if (isset($_GET['title'])) {
    $slug = mysqli_real_escape_string($conn, $_GET['title']);
    $jobQuery = "SELECT * FROM careers WHERE slug = '$slug' LIMIT 1";
} elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Optional: Redirect from ?id=... to ?title=...
    $res = mysqli_query($conn, "SELECT slug FROM careers WHERE id = $id LIMIT 1");
    $row = mysqli_fetch_assoc($res);
    if ($row && !empty($row['slug'])) {
        header("Location: career/" . urlencode($row['slug']));
        exit();
    } else {
        echo "Career not found.";
        exit();
    }
} else {
    echo "Invalid or missing career identifier";
    exit();
}

$jobResult = mysqli_query($conn, $jobQuery);

if (!$jobResult || mysqli_num_rows($jobResult) === 0) {
    echo "Career not found.";
    exit();
}

$job = mysqli_fetch_assoc($jobResult);

// Fetch other jobs
$jobId = (int)$job['id'];
$otherJobsQuery = "SELECT * FROM careers WHERE id != $jobId ORDER BY created_at DESC LIMIT 4";
$otherJobsResult = mysqli_query($conn, $otherJobsQuery);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Careers - Group Nirmal</title>
    <!-- Base URL -->
    <base href="/Group Nirmal 2.0/">
    <link rel="shortcut icon" href="assets/images/logo/fav.png" type="image/x-icon">
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
    <link rel="stylesheet" href="assets/css/view-career.css">

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
                <a href="index.html"><img src="assets/images/logo/logo.png" alt="Nirmal" loading="lazy"></a>
            </div>
            <div class="line"></div>
            <div class="group-logo">
                <img src="assets/images/logo/group-logo.jpg" alt="Group Nirmal" loading="lazy">
            </div>
            <div class="menu-btn">
                <button><img src="assets/images/svg/menu.svg" alt="icon" loading="lazy"> <span>MENU</span></button>
            </div>
        </div>
        <div class="nav-right">
            <div class="social-icons">
                <a href="https://www.facebook.com/groupnirmal?mibextid=ZbWKwL" target="_blank"><img src="assets/images/svg/facebook.svg" alt="facebook" loading="lazy"></a>
                <a href="https://www.instagram.com/group.nirmal?igsh=MWFxZ3BqZzgzamhibg==" target="_blank"><img src="assets/images/svg/instagram.svg" alt="instagram" loading="lazy"></a>
                <a href="https://www.linkedin.com/company/nirmal-wires-private-limited/" target="_blank"><img src="assets/images/svg/linkedin.svg" alt="linkedin" loading="lazy"></a>
                <a href="https://youtube.com/@groupnirmal?si=vw5R2dLVZcAu8S32" target="_blank"><img src="assets/images/svg/youtube.svg" alt="youtube" loading="lazy"></a>
                <a href="https://x.com/NirmalWires" target="_blank"><img src="assets/images/svg/twitter.svg" alt="twitter" loading="lazy"></a>
                <a href="catalogues.html"><img src="assets/images/svg/download.svg" alt="download" loading="lazy"></a>
            </div>
            <a href="contact.html"><button>GET IN TOUCH</button></a>
        </div>
        <!-- Menu List -->
        <div class="nav-menu">
            <a href="/" class="menu">
                <img src="assets/images/menu-icon/menu-icon-01.png" alt="icon" loading="lazy">
                <span>Home</span>
            </a>
            <a href="our-story.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-02.png" alt="icon" loading="lazy">
                <span>Our Story</span>
            </a>
            <a href="products.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-03.png" alt="icon" loading="lazy">
                <span>Products</span>
            </a>
            <a href="quality-assurance.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-04.png" alt="icon" loading="lazy">
                <span>Quality Assurance</span>
            </a>
            <a href="trading.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-11.png" alt="icon" loading="lazy">
                <span>Trading</span>
            </a>
            <a href="our-presence.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-06.png" alt="icon" loading="lazy">
                <span>Our Presence</span>
            </a>
            <a href="csr.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-10.png" alt="icon" loading="lazy">
                <span>CSR</span>
            </a>
            <a href="career.php" class="menu">
                <img src="assets/images/menu-icon/menu-icon-07.png" alt="icon" loading="lazy">
                <span>Careers</span>
            </a>
            <a href="view-blog.php" class="menu">
                <img src="assets/images/menu-icon/blog.png" alt="icon" loading="lazy">
                <span>Blog</span>
            </a>
            <a href="contact.html" class="menu">
                <img src="assets/images/menu-icon/menu-icon-08.png" alt="icon" loading="lazy">
                <span>Contact Us</span>
            </a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Banner Start -->
    <section class="banner">
        <img src="assets/images/career-banner.webp" alt="banner" loading="lazy">
        <div class="banner-content">
            <h1 data-aos="fade-up" data-aos-duration="1000">CAREERS</h1>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Career Start -->

    <!-- Main Section -->
    <div class="job-page-container">
        <a href="careers.php" class="back-link">← Back to Other Positions</a>

        <div class="job-main-section">
            <!-- Job Description -->
            <div class="job-description-card">
                <div class="job-tags">
                    <div class="job-tags-left">
                        <span>Full Time</span>
                        <span>On Site</span>
                    </div>
                    <span class="job-tags-right">Posted on <?= date('M Y', strtotime($job['created_at'])) ?></span>
                </div>

                <h2 class="job-title"><?= htmlspecialchars($job['designation']) ?></h2>
                <div class="job-subtitle"><?= $job['job_description'] ?></div>

                <hr class="divider">

                <h4 class="job-section-title">Roles & Responsibilities</h4>
                <div class="job-body"><?= $job['roles_responsibilities'] ?></div>

                <h4 class="job-section-title">Qualifications & Skills</h4>
                <div class="job-body"><?= $job['qualifications_skills'] ?></div>

                <h4 class="job-section-title">Experience</h4>
                <p class="job-body"><?= htmlspecialchars($job['experience']) ?> years</p>

                <h4 class="job-section-title">Location</h4>
                <p class="job-body"><?= htmlspecialchars($job['location']) ?></p>
            </div>

            <!-- Apply Card -->
            <div class="apply-card">
                <div class="apply-icon">
                    <img src="./assets/images/16249207.png" alt="Apply Icon" loading="lazy" />
                </div>
                <div class="apply-text">
                    <h3>Apply for this job</h3>
                    <p>Submit your application and resume now.</p>
                    <button class="apply-btn" onclick="openForm(<?= $job['id'] ?>)">Apply Now</button>
                </div>
            </div>

            <!-- Popup Overlay -->
            <div id="popupOverlay" class="popup-overlay"></div>

            <!-- Popup Form -->
            <div class="popup-form" id="popupForm" tabindex="0" data-lenis-prevent>
                <span class="close-btn" onclick="closeForm()" aria-label="Close popup">&times;</span>
                <h2>Job Application Form</h2>
                <form enctype="multipart/form-data" method="POST" action="submit-application.php">
                    <input type="hidden" name="career_id" value="<?= $job['id'] ?>">
                    <div class="form-row">
                        <label>First Name *<input type="text" name="first_name" required /></label>
                        <label>Last Name *<input type="text" name="last_name" required /></label>
                    </div>
                    <div class="form-row">
                        <label>Phone Number *<input type="tel" name="phone" required /></label>
                        <label>Current Organization *<input type="text" name="organization" required /></label>
                    </div>
                    <div class="form-row">
                        <label>Current Industry *<input type="text" name="industry" required /></label>
                        <label>Experience *<input type="text" name="experience" required /></label>
                    </div>
                    <div class="form-row">
                        <label>Current CTC *<input type="text" name="current_ctc" required /></label>
                        <label>Expected CTC *<input type="text" name="expected_ctc" required /></label>
                    </div>
                    <div class="form-row">
                        <label>Notice Period *<input type="text" name="notice_period" required /></label>
                        <label>Upload Resume *<input type="file" name="resume" accept=".pdf" required /></label>
                    </div>
                    <!-- Google reCAPTCHA widget -->
                    <div class="g-recaptcha" data-sitekey="6LchbJ0rAAAAAJAyQYfCeuXb7I1ajdHQIZ0ilbv1"></div>
                    <!-- Form Response Message -->
                    <div id="formResponse" style="margin-top: 1rem; font-weight: bold;"></div>
                    <button type="submit" class="submit-btn">Upload</button>
                </form>
            </div>
        </div>

        <!-- Other Jobs -->
        <h3 class="section-heading">Other Positions</h3>
        <div class="other-positions">
            <?php
            include 'db.php';

            // Fetch exactly 2 jobs from the database
            $query = "SELECT id, designation, job_description FROM careers ORDER BY created_at DESC LIMIT 2";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)):
            ?>
                <div class="job-card">
                    <h4><?= htmlspecialchars($row['designation']) ?></h4>
                    <p><?= htmlspecialchars(mb_strimwidth($row['job_description'], 0, 100, '...')) ?></p>

                    <div class="job-divider"></div>

                    <div class="job-meta-apply">
                        <div class="job-meta">
                            <span>Full Time</span> | <span>On Site</span>
                        </div>
                        <a href="view-career.php?id=<?= $row['id'] ?>" class="text-link">Apply now</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="browse-all">
            <a href="career.php"><button class="browse-btn">Browse all Job Positions</button></a>
        </div>
    </div>

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
            <img src="assets/images/svg/whatsapp.svg" alt="WhatsApp" loading="lazy">
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

    <!-- JS for popup -->
    <script>
        const popupForm = document.getElementById('popupForm');
        const popupOverlay = document.getElementById('popupOverlay');
        let scrollPosition = 0;

        function openForm() {
            scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
            popupForm.style.display = 'block';
            popupOverlay.style.display = 'block';
            document.body.style.position = 'fixed';
            document.body.style.top = `-${scrollPosition}px`;
            popupForm.focus();
        }

        function closeForm() {
            popupForm.style.display = 'none';
            popupOverlay.style.display = 'none';
            document.body.style.position = '';
            document.body.style.top = '';
            window.scrollTo(0, scrollPosition);
        }

        popupOverlay.addEventListener('click', closeForm);
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && popupForm.style.display === 'block') {
                closeForm();
            }
        });

        function openForm(jobId) {
            document.getElementById("popupOverlay").style.display = "block";
            document.getElementById("popupForm").style.display = "block";
            document.getElementById("careerIdInput").value = jobId;
        }

        function closeForm() {
            document.getElementById("popupOverlay").style.display = "none";
            document.getElementById("popupForm").style.display = "none";
        }
    </script>

    <!-- Load Google reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</body>

</html>