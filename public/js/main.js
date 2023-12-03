!(function (e) {
    "function" == typeof define && define.amd ? define(e) : e();
})(function () {
    "use strict";
    var e,
        t = "tablerTheme",
        n = new Proxy(new URLSearchParams(window.location.search), {
            get: function (e, t) {
                return e.get(t);
            },
        });
    if (n.theme) localStorage.setItem(t, n.theme), (e = n.theme);
    else {
        var o = localStorage.getItem(t);
        e = o || "light";
    }
    document.body.classList.remove("theme-dark", "theme-light"),
        document.body.classList.add("theme-".concat(e));
});

function deleteConfirmation(url) {
    Swal.fire({
        title: "Supprimer?",
        icon: "question",
        text: "Etes-vous sûr de vouloir supprimer cet élément?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, Supprimer!",
        cancelButtonText: "Non, Annuler!",
        reverseButtons: true,
    }).then((result) => {
        if (result.isConfirmed) {
            var csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");
            var xhr = new XMLHttpRequest();

            xhr.open("DELETE", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("X-CSRF-Token", csrfToken);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var results = JSON.parse(xhr.responseText);
                    if (results.success === true) {
                        Swal.fire("Done!", results.message, "success");
                        // refresh page after 2 seconds
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        Swal.fire("Error!", results.message, "error");
                    }
                }
            };

            xhr.send();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // User clicked on cancel
        }
    });
}

function restore(url) {
    var swalOptions = {
        title: "Restaurer?",
        icon: "question",
        text: "Etes vous sur de vouloir restauré cet element!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, Restauré!",
        cancelButtonText: "Non, Annuler!",
        reverseButtons: true,
    };

    swal(swalOptions).then(function (value) {
        if (value.isConfirmed) {
            var csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("X-CSRF-Token", csrfToken);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        var results = JSON.parse(xhr.responseText);

                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    } else {
                        swal.fire(
                            "Error!",
                            "Request failed with status: " + xhr.status,
                            "error"
                        );
                    }
                }
            };

            xhr.send();
        } else {
            swal.dismiss;
        }
    });
}

(() => {
    "use strict";

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll(".needs-validation");

    // Loop over them and prevent submission
    Array.from(forms).forEach((form) => {
        form.addEventListener(
            "submit",
            (event) => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();

// tom select function
// document.addEventListener("DOMContentLoaded", function () {
//     var el = document.querySelectorAll(".select-tags").forEach((el) => {
//         window.TomSelect &&
//             new TomSelect(el, {
//                 copyClassesToDropdown: false,
//                 dropdownClass: "dropdown-menu ts-dropdown",
//                 optionClass: "dropdown-item",
//                 controlInput: "<input>",
//                 render: {
//                     item: function (data, escape) {
//                         if (data.customProperties) {
//                             return (
//                                 '<div><span class="dropdown-item-indicator">' +
//                                 data.customProperties +
//                                 "</span>" +
//                                 escape(data.text) +
//                                 "</div>"
//                             );
//                         }
//                         return "<div>" + escape(data.text) + "</div>";
//                     },
//                     option: function (data, escape) {
//                         if (data.customProperties) {
//                             return (
//                                 '<div><span class="dropdown-item-indicator">' +
//                                 data.customProperties +
//                                 "</span>" +
//                                 escape(data.text) +
//                                 "</div>"
//                             );
//                         }
//                         return "<div>" + escape(data.text) + "</div>";
//                     },
//                 },
//             });
//     });
// });

// datatable search function
// $(document).ready(function () {
//     $("#search-input").on("keyup", function () {
//         var value = $(this).val().toLowerCase();
//         var matchedRows = $("#datatable tbody tr").filter(function () {
//             return $(this).text().toLowerCase().indexOf(value) > -1;
//         });
//         $("#datatable tbody tr").not(matchedRows).hide();
//         matchedRows.show();
//         if (matchedRows.length == 0) {
//             $("#no-results").show();
//         } else {
//             $("#no-results").hide();
//         }
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    let options = {
        selector: "#tinymce-default",
        height: 300,
        menubar: true,
        statusbar: false,
        plugins: [
            "advlist autolink lists link image charmap print preview anchor",
            "searchreplace visualblocks code fullscreen",
            "insertdatetime media table paste code help wordcount",
        ],
        toolbar:
            "undo redo | formatselect | " +
            "bold italic backcolor | alignleft aligncenter " +
            "alignright alignjustify | bullist numlist outdent indent | " +
            "removeformat",
        content_style:
            "body { font-family: -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif; font-size: 14px; -webkit-font-smoothing: antialiased; }",
    };
    if (localStorage.getItem("tablerTheme") === "dark") {
        options.skin = "oxide-dark";
        options.content_css = "dark";
    }
    tinyMCE.init(options);
});
