document.addEventListener("DOMContentLoaded", function () {
    renderCharts();
    initSyncLoading();
    initNavbarToggle();
});

function renderCharts() {
    const genres = window.dashboardData.genres;
    const moviesPerDate = window.dashboardData.moviesPerDate;
    const moviesPerReleaseDate = window.dashboardData.moviesPerReleaseDate;

    new ApexCharts(
        document.querySelector("#genreChart"),
        {
            series: Object.values(genres),
            labels: Object.keys(genres),
            chart: {
                type: "pie",
                width: 600,
            },
        },
    ).render();

    new ApexCharts(
        document.querySelector("#dateChart"),
        {
            series: [
                {
                    name: "Movies",
                    data: Object.values(moviesPerDate),
                },
            ],
            chart: {
                type: "bar",
                height: 350,
            },
            xaxis: {
                categories: Object.keys(moviesPerDate),
            },
        },
    ).render();

    new ApexCharts(
        document.querySelector("#releaseChart"),
        {
            series: [
                {
                    name: "Movies",
                    data: Object.values(moviesPerReleaseDate),
                },
            ],
            chart: {
                type: "bar",
                height: 350,
            },
            xaxis: {
                categories: Object.keys(moviesPerReleaseDate),
            },
        },
    ).render();
}

function initSyncLoading() {
    document
        .getElementById("syncForm")
        .addEventListener("submit", function () {
            document.getElementById("syncButton").disabled = true;
            document.getElementById("syncText").classList.add("d-none");
            document.getElementById("syncLoading").classList.remove("d-none");
            document.getElementById("loadingOverlay").style.display = "block";
        });
}

function initNavbarToggle() {
    const navLinks = document.querySelectorAll("#sidebar-menu .nav-link");
    const navbarCollapse = document.getElementById("sidebar-menu");

    navLinks.forEach((link) => {
        link.addEventListener("click", function () {
            if (window.innerWidth < 992) {
                const bsCollapse =
                    bootstrap.Collapse.getInstance(navbarCollapse);
                if (bsCollapse) {
                    bsCollapse.hide();
                }
            }
        });
    });
}