$(document).ready(function () {
  console.log("Velora MotoCare script.js berjalan.");

  /* ===== DOM FILTER LAYANAN ===== */

  $(".btn-filter").on("click", function () {
    const selectedCategory = $(this).data("filter");

    $(".btn-filter").removeClass("active");
    $(this).addClass("active");

    if (selectedCategory === "all") {
      $(".service-item").show();
      return;
    }

    $(".service-item").each(function () {
      const serviceCategory = $(this).data("category");

      if (serviceCategory === selectedCategory) {
        $(this).show();
      } else {
        $(this).hide();
      }
    });
  });

  /* ===== DOM ESTIMATOR PAKET SERVIS ===== */

  $("#estimatorForm").on("submit", function (event) {
    event.preventDefault();

    const motorType = $("#motorType").val();
    const mainService = $("#mainService").val();
    const additionalServices = $(".additional-service:checked");

    if (motorType === "" || mainService === "") {
      $("#estimatorResult").html(
        `<span class="text-danger">Silakan pilih jenis motor dan layanan utama terlebih dahulu.</span>`,
      );
      return;
    }

    const motorTypePrices = {
      matic: 0,
      bebek: 5000,
      sport: 15000,
    };

    const mainServicePrices = {
      "ganti-oli": 45000,
      "servis-cvt": 65000,
      detailing: 75000,
      "full-checkup": 120000,
    };

    const additionalServicePrices = {
      "cek-aki": 10000,
      "cek-rem": 10000,
      "cek-ban": 5000,
    };

    let totalPrice =
      motorTypePrices[motorType] + mainServicePrices[mainService];

    additionalServices.each(function () {
      const selectedAdditional = $(this).val();
      totalPrice += additionalServicePrices[selectedAdditional];
    });

    let recommendation = "Paket Basic";

    if (totalPrice >= 80000 && totalPrice < 130000) {
      recommendation = "Paket Daily Care";
    } else if (totalPrice >= 130000) {
      recommendation = "Paket Full Checkup";
    }

    const formattedPrice = totalPrice.toLocaleString("id-ID");

    $("#estimatorResult").html(`
      <strong>Total estimasi:</strong> Rp${formattedPrice}<br>
      <strong>Rekomendasi:</strong> ${recommendation}<br>
      <strong>Catatan:</strong> Estimasi ini bersifat simulasi.
    `);
  });

  /* ===== DOM CHECKLIST MOTOR SEHAT INTERAKTIF ===== */

  $(".health-check").on("change", function () {
    const totalChecklist = $(".health-check").length;
    const checkedTotal = $(".health-check:checked").length;

    let status = "";
    let statusClass = "";

    if (checkedTotal >= 5) {
      status = "Motor Aman";
      statusClass = "text-success";
    } else if (checkedTotal >= 3) {
      status = "Perlu Dicek";
      statusClass = "text-warning";
    } else {
      status = "Segera Servis";
      statusClass = "text-danger";
    }

    $("#healthResult").html(`
      <strong>Status:</strong> <span class="${statusClass}">${status}</span><br>
      <strong>Checklist terpenuhi:</strong> ${checkedTotal} dari ${totalChecklist}
    `);
  });

  /* ===== DOM VALIDASI FORM BOOKING ===== */
  // Data booking hanya ditampilkan ulang di halaman.

  $("#bookingForm").on("submit", function (event) {
    event.preventDefault();

    const customerName = $("#customerName").val().trim();
    const bookingMotor = $("#bookingMotor").val().trim();
    const bookingService = $("#bookingService").val();
    const bookingDate = $("#bookingDate").val();

    if (
      customerName === "" ||
      bookingMotor === "" ||
      bookingService === "" ||
      bookingDate === ""
    ) {
      $("#bookingResult").html(
        `<span class="text-danger">Semua field booking wajib diisi.</span>`,
      );
      return;
    }

    // Display booking locally (no server persistence)
    $("#bookingResult").html(`
      <div class="p-3 bg-white text-dark rounded">
        <strong class='text-success'>Booking berhasil (simulasi).</strong><br>
        Nama: ${customerName}<br>
        Motor: ${bookingMotor}<br>
        Layanan: ${bookingService}<br>
        Tanggal: ${bookingDate}
      </div>
    `);
    $("#bookingForm")[0].reset();
  });

  // Tambahan: animate dari 0
  const counters = document.querySelectorAll(".counter");
  const hargaCounters = document.querySelectorAll(".price-counter");

  function formatNumber(value) {
    return Number(value).toLocaleString("id-ID");
  }

  function animateCounter(counter) {
    const target = Number(counter.dataset.target);
    const suffix = counter.dataset.suffix || "";
    const duration = 1200;
    const startTime = performance.now();

    function update(currentTime) {
      const elapsed = currentTime - startTime;
      const progress = Math.min(elapsed / duration, 1);

      const value = Math.floor(progress * target);
      counter.textContent = formatNumber(value) + suffix;

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        counter.textContent = formatNumber(target) + suffix;
      }
    }

    requestAnimationFrame(update);
  }

  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animateCounter(entry.target);
          observer.unobserve(entry.target);
        }
      });
    },
    {
      threshold: 0.5,
    },
  );

  counters.forEach((counter) => observer.observe(counter));
  hargaCounters.forEach((counter) => observer.observe(counter));

  // Tambahan: efek ketik untuk hero section
  const typingText = document.getElementById("typing-text");

  const words = ["Sehat Tiap Hari.", "Enak Tiap Hari.", "Aman Tiap Hari."];

  let wordIndex = 0;
  let charIndex = 0;
  let isDeleting = false;

  function typeEffect() {
    const currentWord = words[wordIndex];

    if (isDeleting) {
      typingText.textContent = currentWord.substring(0, charIndex - 1);
      charIndex--;
    } else {
      typingText.textContent = currentWord.substring(0, charIndex + 1);
      charIndex++;
    }

    let speed = isDeleting ? 45 : 85;

    if (!isDeleting && charIndex === currentWord.length) {
      speed = 1400;
      isDeleting = true;
    }

    if (isDeleting && charIndex === 0) {
      isDeleting = false;
      wordIndex = (wordIndex + 1) % words.length;
      speed = 400;
    }

    setTimeout(typeEffect, speed);
  }

  typeEffect();
});
