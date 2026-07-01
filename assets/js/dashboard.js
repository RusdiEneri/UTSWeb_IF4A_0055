// Dashboard JS: Chart.js init, timeline animations
document.addEventListener("DOMContentLoaded", function () {
  // Chart.js revenue chart
  if (window.Chart) {
    const ctx = document.getElementById("revenueChart");
    if (ctx) {
      new Chart(ctx, {
        type: "line",
        data: {
          labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun"],
          datasets: [
            {
              label: "Pengeluaran Servis",
              data: [120000, 90000, 150000, 130000, 110000, 170000],
              borderColor:
                getComputedStyle(document.documentElement).getPropertyValue(
                  "--color-orange",
                ) || "#F97316",
              backgroundColor: "rgba(249,115,22,0.08)",
              fill: true,
              tension: 0.3,
            },
          ],
        },
        options: {
          plugins: { legend: { display: false } },
          scales: { y: { beginAtZero: false } },
        },
      });
    }
  }

  // simple progress animation
  const prog = document.querySelectorAll(".profile-progress");
  prog.forEach((p) => {
    const val = p.dataset.value || 0;
    p.style.width = Math.min(100, val) + "%";
  });
});
