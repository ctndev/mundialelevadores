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
      var texto = "Olá! Meu nome é " + nome + ".\nTelefone: " + telefone;
      var assunto = (data.get("assunto") || "").toString().trim();
      var paradas = (data.get("paradas") || "").toString().trim();
      if (assunto) texto += "\nAssunto: " + assunto;
      if (paradas) texto += "\nInteresse: " + (product ? product + " (" + paradas + ")" : paradas);
      texto += "\n" + ((data.get("mensagem") || "").toString().trim() || "Gostaria de um orçamento.");
      window.open("https://api.whatsapp.com/send?phone=" + WHATS + "&text=" + encodeURIComponent(texto), "_blank");
    });
  }
})();
