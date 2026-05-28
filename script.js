$(document).ready(function () {
  console.log("Velora MotoCare script.js berjalan.")

  /* ===== FITUR DOM 1: FILTER LAYANAN ===== */

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
});