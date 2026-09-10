/* Mundial Elevadores Fortaleza — JavaScript puro */
(function () {
  "use strict";

  var WHATS = (document.body && document.body.getAttribute("data-whatsapp")) || "";

  var year = document.getElementById("year");
  if (year) year.textContent = String(new Date().getFullYear());

  var header = document.getElementById("site-header");
  function onScroll() {
    if (!header) return;
    if (window.scrollY > 40) header.classList.add("is-solid");
    else header.classList.remove("is-solid");
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  var toggle = document.getElementById("nav-toggle");
  var nav = document.getElementById("main-nav");
  if (toggle && nav) {
    toggle.addEventListener("click", function () {
      var open = nav.classList.toggle("is-open");
      toggle.setAttribute("aria-expanded", open ? "true" : "false");
    });
    nav.addEventListener("click", function (e) {
      if (e.target.tagName === "A") {
        nav.classList.remove("is-open");
        toggle.setAttribute("aria-expanded", "false");
      }
    });
  }

  var slides = document.querySelectorAll(".hero-slide");
  if (slides.length > 1) {
    var i = 0;
    setInterval(function () {
      slides[i].classList.remove("is-active");
      i = (i + 1) % slides.length;
      slides[i].classList.add("is-active");
    }, 6000);
  }

  var revealables = document.querySelectorAll(".reveal");
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            io.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.12 }
    );
    revealables.forEach(function (el) {
      io.observe(el);
    });
  } else {
    revealables.forEach(function (el) {
      el.classList.add("is-visible");
    });
  }

  var lightbox = document.getElementById("lightbox");
  var lightboxImg = document.getElementById("lightbox-img");
  var lightboxClose = document.getElementById("lightbox-close");

  function closeLightbox() {
    if (lightbox) lightbox.hidden = true;
  }

  document.querySelectorAll(".gallery-item").forEach(function (btn) {
    btn.addEventListener("click", function () {
      var img = btn.querySelector("img");
      if (!img || !lightbox || !lightboxImg) return;
      lightboxImg.src = img.src;
      lightboxImg.alt = img.alt;
      lightbox.hidden = false;
    });
  });
  if (lightboxClose) lightboxClose.addEventListener("click", closeLightbox);
  if (lightbox)
    lightbox.addEventListener("click", function (e) {
      if (e.target === lightbox) closeLightbox();
    });
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") closeLightbox();
  });

  var COOKIE_KEY = "mef-cookie-consent";
  var cookieBanner = document.getElementById("cookie-banner");
  var cookieAccept = document.getElementById("cookie-banner-accept");

  if (cookieBanner) {
    if (window.localStorage.getItem(COOKIE_KEY) !== "1") cookieBanner.hidden = false;
    if (cookieAccept) {
      cookieAccept.addEventListener("click", function () {
        window.localStorage.setItem(COOKIE_KEY, "1");
        cookieBanner.hidden = true;
      });
    }
  }

  var form = document.getElementById("contact-form");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      var data = new FormData(form);
      var nome = (data.get("nome") || "").toString().trim();
      var telefone = (data.get("telefone") || "").toString().trim();
      if (!nome || !telefone) {
        alert("Por favor, informe seu nome e telefone.");
        return;
      }

      var product = (form.getAttribute("data-product") || "").trim();
      var mensagem = (data.get("mensagem") || "").toString().trim();
      data.set("nome", nome);
      data.set("telefone", telefone);
      data.set("mensagem", mensagem);
      data.set("produto", product);
      data.set("pagina", window.location.pathname || "/");

      var texto = "Olá! Meu nome é " + nome + ".";
      var paradas = (data.get("paradas") || "").toString().trim();
      if (paradas) texto += "\nInteresse: " + (product ? product + " (" + paradas + ")" : paradas);
      else if (product) texto += "\nInteresse: " + product;
      if (mensagem) texto += "\n" + mensagem;

      if (WHATS) {
        window.open(
          "https://api.whatsapp.com/send?phone=" + WHATS + "&text=" + encodeURIComponent(texto),
          "_blank"
        );
      }

      var csrf = document.querySelector('meta[name="csrf-token"]');
      var submit = form.querySelector('[type="submit"]');
      if (submit) submit.disabled = true;

      fetch(form.action, {
        method: "POST",
        headers: {
          Accept: "application/json",
          "X-Requested-With": "XMLHttpRequest",
          "X-CSRF-TOKEN": csrf ? csrf.getAttribute("content") : "",
        },
        body: data,
      })
        .then(function (response) {
          if (response.status === 429) {
            return;
          }
          if (!response.ok) {
            throw new Error("Falha ao salvar o contato.");
          }
        })
        .catch(function () {
          alert("Não foi possível registrar o contato no site. Você já pode continuar pelo WhatsApp.");
        })
        .finally(function () {
          if (submit) submit.disabled = false;
        });
    });
  }
})();
