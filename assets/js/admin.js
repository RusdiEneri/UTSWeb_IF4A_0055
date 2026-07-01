// Admin JS: DataTables init, modal transitions, sparkline placeholders
$(document).ready(function () {
  if ($.fn.DataTable) {
    $("#servicesTable").DataTable({
      responsive: true,
      pageLength: 10,
      order: [[0, "desc"]],
    });
  }

  // Row click to open modal with details
  $(document).on("click", ".view-details", function (e) {
    e.preventDefault();
    const id = $(this).data("id");
    $("#modalDetail .modal-body").html(
      "<p>Loading detail for ID " + id + "</p>",
    );
    $("#modalDetail").modal("show");
  });
});
