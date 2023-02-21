// SIDEBAR TOGGLE DROPDOWN
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".sidebar .nav-link").forEach(function (element) {
        element.addEventListener("click", function (e) {
            let nextEl = element.nextElementSibling;
            let parentEl = element.parentElement;

            if (nextEl) {
                e.preventDefault();
                let mycollapse = new bootstrap.Collapse(nextEl);

                if (nextEl.classList.contains("show")) {
                    mycollapse.hide();
                } else {
                    mycollapse.show();
                    // find other submenus with class=show
                    var opened_submenu =
                        parentEl.parentElement.querySelector(".submenu.show");
                    // if it exists, then close all of them
                    if (opened_submenu) {
                        new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        });
    });
});

// DATATABLE DASHBOARD
$(document).ready(function () {
    $("#dashboard_table").DataTable({
        lengthChange: false,
        info: false,
        paging: false,
        ordering: false,
        searching: false,
    });
});

// OTHER DATATABLE
$(document).ready(function () {
    var table = $("#table_data").DataTable({
        lengthChange: false,
        sort: false,
        initComplete: function () {
            if (this.api().data().length <= 0) {
                $(".dataTables_paginate").hide();
                $(".dataTables_info").hide();
            }
        },
        language: {
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            infoEmpty: "Data tidak ditemukan",
            infoFiltered: "(disaring dari total _MAX_ entri)",
            zeroRecords: "Tidak ada data",
            paginate: {
                next: '<i class="fas cursor-pointer fa-chevron-right"></i>',
                previous: '<i class="fas cursor-pointer fa-chevron-left"></i>',
            },
        },
    });
    $("#search-input").keyup(function () {
        table.search(this.value).draw();
        document
            .querySelector("#exportLaporanMasuk")
            .setAttribute("href", "/export/surat-masuk?search=" + this.value);
        document
            .querySelector("#exportLaporanKeluar")
            .setAttribute("href", "/export/surat-keluar?search=" + this.value);
    });
});

$(document).ready(function () {
    const date = new Date();
    const weekdays = [
        "Minggu",
        "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jumat",
        "Sabtu",
    ];
    const dayName = weekdays[date.getDay()];
    const dayNumber = date.getDate();
    const monthName = new Intl.DateTimeFormat("id-ID", {
        month: "long",
    }).format(date);

    const formattedDate = `${dayName}, ${dayNumber} ${monthName} ${date.getFullYear()}`;
    document.querySelector("#current_date").innerHTML = formattedDate;
});

// HIDE ALERT
setTimeout(function () {
    document.getElementById("alert-div").style.display = "none";
}, 3000);
