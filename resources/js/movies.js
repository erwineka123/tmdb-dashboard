document.addEventListener("DOMContentLoaded", function () {
    fixPaginationStyle();
    initDeleteConfirm();
});

function fixPaginationStyle() {
    const pagination = document.querySelector(".pagination");
    if (!pagination) return;
    pagination.classList.add("pagination");
    pagination.parentElement.classList.add("d-flex", "justify-content-center");
    pagination.querySelectorAll("li").forEach((li) => {
        li.classList.add("page-item");
        const link = li.querySelector("a, span");
        if (link) {
            link.classList.add("page-link");
        }
    });
}

function initDeleteConfirm() {
    document
        .querySelectorAll("form button.btn-danger")
        .forEach((button) => {
            button.addEventListener("click", function (e) {
                if (!confirm("Are you sure to delete this movie?")) {
                    e.preventDefault();
                }
            });
        });
}
