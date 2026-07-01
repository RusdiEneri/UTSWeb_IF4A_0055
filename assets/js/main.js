/* Main JS for landing interactions */
// Dependencies: jQuery, AOS
document.addEventListener("DOMContentLoaded", function () {
  // AOS init
  if (window.AOS)
    AOS.init({ once: true, duration: 700, easing: "ease-out-cubic" });

  // Navbar shrink on scroll
  const navbar = document.querySelector(".main-navbar");
  const hero = document.querySelector("#hero");
  function onScroll() {
    if (window.scrollY > 80) navbar.classList.add("shrink");
    else navbar.classList.remove("shrink");
  }
  window.addEventListener("scroll", onScroll);

  // Counters when in view
  const counters = document.querySelectorAll(".price-counter, .counter");
  const counterObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const el = entry.target;
          let target = parseInt(el.dataset.target || el.textContent || 0, 10);
          if (isNaN(target)) return;
          let start = 0;
          const duration = 900;
          const stepTime = Math.max(16, duration / target);
          const timer = setInterval(() => {
            start += Math.ceil(target / 30);
            el.textContent = start;
            if (start >= target) {
              el.textContent = target;
              clearInterval(timer);
            }
          }, stepTime);
          counterObserver.unobserve(el);
        }
      });
    },
    { threshold: 0.6 },
  );
  counters.forEach((c) => counterObserver.observe(c));

  // Filter buttons (client-only filtering by data-category)
  $(".btn-filter").on("click", function () {
    $(".btn-filter").removeClass("active");
    $(this).addClass("active");
    const f = $(this).data("filter");
    if (f === "all") $(".service-item").show();
    else
      $(".service-item")
        .hide()
        .filter('[data-category="' + f + '"]')
        .show();
  });

  // skeleton simulation: fade from skeleton to real items
  const serviceList = document.getElementById("serviceList");
  if (serviceList) {
    const skeletons = serviceList.querySelectorAll(".service-item");
    // add skeleton class then remove to simulate async loading
    skeletons.forEach((s) => s.classList.add("skeleton"));
    setTimeout(() => {
      skeletons.forEach((s) => s.classList.remove("skeleton"));
      if (window.AOS && AOS.refresh) AOS.refresh();
    }, 600);
  }

  // Cursor-follow highlight on service cards
  const serviceCards = document.querySelectorAll(".service-card");
  serviceCards.forEach((card) => {
    card.classList.add("card-highlight");
    card.addEventListener("mousemove", (e) => {
      const r = card.getBoundingClientRect();
      const x = e.clientX - r.left;
      const y = e.clientY - r.top;
      card.style.setProperty("--mx", x + "px");
      card.style.setProperty("--my", y + "px");
    });
    card.addEventListener("mouseenter", () => card.classList.add("hovered"));
    card.addEventListener("mouseleave", () => card.classList.remove("hovered"));
  });

  // Testimonial simple carousel (center stage)
  const tCards = Array.from(document.querySelectorAll(".testimonial-card"));
  if (tCards.length) {
    let tIndex = 0;
    const tInterval = 4500;
    function showTestimonial(i) {
      tCards.forEach((c, idx) => c.classList.toggle("is-active", idx === i));
    }
    showTestimonial(tIndex);
    let tTimer = setInterval(() => {
      tIndex = (tIndex + 1) % tCards.length;
      showTestimonial(tIndex);
    }, tInterval);
    // prev/next controls
    const prev = document.querySelector(".testimonial-prev");
    const next = document.querySelector(".testimonial-next");
    if (prev)
      prev.addEventListener("click", () => {
        clearInterval(tTimer);
        tIndex = (tIndex - 1 + tCards.length) % tCards.length;
        showTestimonial(tIndex);
        tTimer = setInterval(() => {
          tIndex = (tIndex + 1) % tCards.length;
          showTestimonial(tIndex);
        }, tInterval);
      });
    if (next)
      next.addEventListener("click", () => {
        clearInterval(tTimer);
        tIndex = (tIndex + 1) % tCards.length;
        showTestimonial(tIndex);
        tTimer = setInterval(() => {
          tIndex = (tIndex + 1) % tCards.length;
          showTestimonial(tIndex);
        }, tInterval);
      });
  }

  // Estimator live animation
  const estimatorForm = document.getElementById("estimatorForm");
  const estimatorResult = document.getElementById("estimatorResult");
  if (estimatorForm && estimatorResult) {
    estimatorForm.addEventListener("submit", function (e) {
      e.preventDefault();
      const main = document.getElementById("mainService").value;
      const extras = Array.from(
        document.querySelectorAll(".additional-service:checked"),
      ).map((i) => i.value);
      const priceMap = {
        "ganti-oli": 35000,
        "servis-cvt": 85000,
        detailing: 80000,
        "full-checkup": 150000,
      };
      let base = priceMap[main] || 0;
      let extraSum = extras.length * 10000;
      let total = base + extraSum;
      // build flip card
      estimatorResult.innerHTML = `
        <div class="estimator-result">
          <div class="estimator-front estimator-front p-3 bg-white rounded shadow-sm">
            <div class="small text-muted">Estimasi untuk pilihan Anda</div>
            <div class="h4 mt-2">Rp <span class="est-price">-</span></div>
          </div>
          <div class="estimator-back estimator-back p-3 bg-white rounded shadow-sm">
            <div class="small text-muted">Estimasi total</div>
            <div class="h3 mt-2">Rp <span class="est-price-back">0</span></div>
          </div>
        </div>
      `;
      const resultEl = estimatorResult.querySelector(".estimator-result");
      // trigger flip
      setTimeout(() => resultEl.classList.add("flipped"), 80);
      // animate number
      const display = estimatorResult.querySelector(".est-price-back");
      let cur = 0;
      const step = Math.max(1, Math.floor(total / 30));
      const t = setInterval(() => {
        cur += step;
        if (cur >= total) {
          display.textContent = total.toLocaleString("id-ID");
          clearInterval(t);
        } else {
          display.textContent = cur.toLocaleString("id-ID");
        }
      }, 20);
      // unflip after a short while
      setTimeout(() => resultEl.classList.remove("flipped"), 3500);
    });
  }
});
