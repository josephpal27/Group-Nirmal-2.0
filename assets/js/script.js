
// Functionality For Navbar
let navMenuBtn = document.querySelector('nav .menu-btn button');
let navMenu = document.querySelector('nav .nav-menu');

// Helper to toggle body scroll and Lenis
function toggleBodyScrollAndLenis(disable) {
    if (disable) {
        document.body.style.overflow = 'hidden';
        document.body.style.touchAction = 'none';
        if (typeof lenis !== 'undefined') lenis.stop();
    } else {
        document.body.style.overflow = '';
        document.body.style.touchAction = '';
        if (typeof lenis !== 'undefined') lenis.start();
    }
}

navMenuBtn.addEventListener('click', () => {
    navMenu.classList.toggle('active');
    if (window.innerWidth <= 767) {
        toggleBodyScrollAndLenis(navMenu.classList.contains('active'));
    }
});

document.addEventListener('click', (event) => {
    if (!navMenu.contains(event.target) && !navMenuBtn.contains(event.target)) {
        navMenu.classList.remove('active');
        if (window.innerWidth <= 767) {
            toggleBodyScrollAndLenis(false);
        }
    }
});

// Restore scroll and Lenis if resized above 767px
window.addEventListener('resize', () => {
    if (window.innerWidth > 767) {
        toggleBodyScrollAndLenis(false);
    }
});

// ----------------------------------------------------------------------------------------------------

// Functionality For Product Internal Pages
let productCards = document.querySelectorAll('.product-cards-row .product-card');

productCards.forEach((productCard) => {
    productCard.addEventListener('mouseenter', () => {
        let layer1 = productCard.querySelector('.layer-1');
        let layer2 = productCard.querySelector('.layer-2');
        layer1.classList.add('hide');
        layer2.classList.add('show');
    });

    productCard.addEventListener('mouseleave', () => {
        let layer1 = productCard.querySelector('.layer-1');
        let layer2 = productCard.querySelector('.layer-2');
        layer1.classList.remove('hide');
        layer2.classList.remove('show');
    });
});

// ----------------------------------------------------------------------------------------------------

// Refresh AOS on scroll
window.onscroll = () => {
    AOS.refresh();
}

// ----------------------------------------------------------------------------------------------------

// Functionality For CSR Page Modal Section
let modal = document.querySelector('#tabModal');
let modalHead = document.querySelector('#tabModal #tabModalLabel');
let modalBody = document.querySelector('#tabModal .modal-body .modal-text-content p');
let modalSwiperWrapper = document.querySelector('#tabModal .swiper-wrapper');
let csrCards = document.querySelectorAll('.csr-card');

let modalSwiperInstance; // Variable to store the modal Swiper instance

csrCards.forEach((card) => {
    card.addEventListener('click', () => {
        // Get the heading and description
        let cardHeading = card.querySelector('h3').textContent;
        let cardDesc = card.querySelector('.content-for-modal .para p').textContent;

        // Set the modal heading and description
        modalHead.textContent = cardHeading;
        modalBody.textContent = cardDesc;

        // Clear existing slides in the Swiper
        modalSwiperWrapper.innerHTML = '';

        // Get images from the .content-for-modal div
        let images = card.querySelectorAll('.content-for-modal .images img');

        // Create slides dynamically based on the images
        images.forEach((img) => {
            let slide = document.createElement('div');
            slide.classList.add('swiper-slide');
            slide.innerHTML = `<img src="${img.src}" alt="${img.alt}">`;
            modalSwiperWrapper.appendChild(slide);
        });

        // Destroy the existing modal Swiper instance if it exists
        if (modalSwiperInstance) {
            modalSwiperInstance.destroy(true, true);
        }

        // Reinitialize Swiper for modal only
        modalSwiperInstance = new Swiper('.modal-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            loop: false,
        });
    });
});


// Close modal when clicking outside the modal content
document.addEventListener('click', (event) => {
    const modal = document.querySelector('#tabModal');
    const modalDialog = modal.querySelector('.modal-dialog');

    if (modal.classList.contains('show') && !modalDialog.contains(event.target)) {
        const bootstrapModal = bootstrap.Modal.getInstance(modal); // Get the Bootstrap modal instance
        bootstrapModal.hide(); // Hide the modal
    }
});

// ----------------------------------------------------------------------------------------------------

// Functionality For Internal Product Pages Contact Form Phone Input Flags Selector
const phoneInput = document.querySelector(".get-in-touch-form #phone");
const iti = window.intlTelInput(phoneInput, {
    initialCountry: "in",
    separateDialCode: true,
    preferredCountries: ["in", "us", "gb", "au"],
    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.19/build/js/utils.js",
});

document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault();
});

phoneInput.addEventListener('input', function () {
    // Remove all non-digit characters and limit to 10 digits
    this.value = this.value.replace(/\D/g, '').slice(0, 10);
});

phoneInput.placeholder = "";

// ----------------------------------------------------------------------------------------------------

// Functionality For Product & Internal Product Pages Read More Section
function toggleReadMore() {
  let extra = document.getElementById("extraContent");
  let btn = document.getElementById("readMoreBtn");

  let isHidden = !extra.classList.contains("show");

  if (isHidden) {
    extra.classList.add("show");
    btn.textContent = "READ LESS";
  } else {
    extra.classList.remove("show");
    btn.textContent = "READ MORE";
  }
}

// ----------------------------------------------------------------------------------------------------

// Functionality Product Internal Pages Contact Form
document.querySelector("form").addEventListener("submit", function (e) {
  e.preventDefault(); // Stop default submission

  const form = e.target;
  const formData = new FormData(form);
  const responseBox = document.getElementById("formResponse");

  fetch("submit-contact.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.json())
    .then((data) => {
      if (data.status === "success") {
        responseBox.style.color = "green";
        form.reset(); // clear form
      } else {
        responseBox.style.color = "red";
      }
      responseBox.innerText = data.message;
    })
    .catch(() => {
      responseBox.style.color = "red";
      responseBox.innerText = "Something went wrong.";
    });
});

// ----------------------------------------------------------------------------------------------------

// Functionality Product Internal Pages Enquire Now Buttons
document
  .querySelectorAll(
    ".banner .banner-btn-row button, .apps button, .after-sale .after-sale-left button"
  )
  .forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      // Remove lazy loading before scroll
      document.querySelectorAll('img[loading="lazy"]').forEach((img) => {
        img.removeAttribute("loading");
      });

      // Smooth scroll
      setTimeout(() => {
        document.querySelector("#get-in-touch").scrollIntoView({
          behavior: "smooth",
        });

        // Re-apply lazy loading after scroll completes (~2-3 seconds)
        setTimeout(() => {
          document.querySelectorAll("img").forEach((img) => {
            if (!img.hasAttribute("loading")) {
              img.setAttribute("loading", "lazy");
            }
          });
        }, 2500);
      }, 200);
    });
  });

  // ----------------------------------------------------------------------------------------------------

  // Functionality Product Internal Pages Applications Cards Hover (Desktop) and Click (Mobile) Effect
  let appsCard = document.querySelectorAll(".apps-card");
  let blueLayer = document.querySelectorAll(".blue-layer");

  function setupCardInteractions() {
    // Remove previous event listeners by cloning elements
    appsCard.forEach((card) => {
      let newCard = card.cloneNode(true);
      card.parentNode.replaceChild(newCard, card);
    });

    // Re-select after cloning
    appsCard = document.querySelectorAll(".apps-card");
    blueLayer = document.querySelectorAll(".blue-layer");

    if (window.innerWidth > 767) {
      // Desktop Hover
      appsCard.forEach((card, index) => {
        card.addEventListener("mouseenter", () => {
          blueLayer[index].style.bottom = "0";
        });
        card.addEventListener("mouseleave", () => {
          blueLayer[index].style.bottom = "-100%";
        });
      });
    } else {
      // Mobile Click
      appsCard.forEach((card, index) => {
        card.addEventListener("click", (e) => {
          e.stopPropagation(); // Prevent closing immediately when clicking the card
          let isAlreadyOpen =
            blueLayer[index].style.bottom === "0px" ||
            blueLayer[index].style.bottom === "0";

          // Close all layers
          blueLayer.forEach((layer) => {
            layer.style.bottom = "-100%";
          });

          // Open only if not already open
          if (!isAlreadyOpen) {
            blueLayer[index].style.bottom = "0";
          }
        });
      });

      // Close layers when clicking outside
      document.addEventListener("click", () => {
        blueLayer.forEach((layer) => {
          layer.style.bottom = "-100%";
        });
      });
    }
  }

  // Run on load
  setupCardInteractions();

  // Run on resize
  window.addEventListener("resize", setupCardInteractions);

  // ----------------------------------------------------------------------------------------------------

  // Functionality Niznal Vineyard Support System Cards Hover (Desktop) and Click (Mobile) Effect
  let supportCard = document.querySelectorAll(
    ".support-card-row .support-card"
  );
  let SupportCardLayer = document.querySelectorAll(
    ".support-card-row .support-card-layer"
  );

  function setupSupportCardInteractions() {
    // Reset event listeners by cloning elements
    supportCard.forEach((card) => {
      let newCard = card.cloneNode(true);
      card.parentNode.replaceChild(newCard, card);
    });

    // Re-select after cloning
    supportCard = document.querySelectorAll(".support-card-row .support-card");
    SupportCardLayer = document.querySelectorAll(
      ".support-card-row .support-card-layer"
    );

    if (window.innerWidth > 767) {
      // Desktop Hover Effect
      supportCard.forEach((card, index) => {
        card.addEventListener("mouseenter", () => {
          SupportCardLayer[index].style.bottom = "0";
        });
        card.addEventListener("mouseleave", () => {
          SupportCardLayer[index].style.bottom = "-100%";
        });
      });
    } else {
      // Mobile Click Effect (only one open at a time)
      supportCard.forEach((card, index) => {
        card.addEventListener("click", () => {
          let isAlreadyOpen =
            SupportCardLayer[index].style.bottom === "0px" ||
            SupportCardLayer[index].style.bottom === "0";

          // Close all first
          SupportCardLayer.forEach((layer) => {
            layer.style.bottom = "-100%";
          });

          // Open only if it wasn't open
          if (!isAlreadyOpen) {
            SupportCardLayer[index].style.bottom = "0";
          }
        });
      });
    }
  }

  // Run on load
  setupSupportCardInteractions();

  // Run on resize
  window.addEventListener("resize", setupSupportCardInteractions);

  // ----------------------------------------------------------------------------------------------------

  // Functionality For Product Internal Pages Get in Touch Form Google reCAPTCHA
  function showMessage(event) {
    event.preventDefault();

    const form = document.querySelector("#get-in-touch form");
    const formData = new FormData(form);
    const formMessage = document.getElementById("formMessage");
    const recaptchaResponse = grecaptcha.getResponse();

    if (recaptchaResponse) {
        fetch(form.action, {
            method: form.method,
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            formMessage.style.color = "green";
            formMessage.innerText = "Thank you! We have received your message.";

            form.reset();
            phoneInput.placeholder = "";
        })
        .catch(error => {
            formMessage.style.color = "red";
            formMessage.innerText = "Error sending message. Please try again.";
            console.error(error);
        });
    } else {
        formMessage.style.color = "red";
        formMessage.innerText = "Please verify the CAPTCHA to proceed.";
    }
  }
  // ----------------------------------------------------------------------------------------------------