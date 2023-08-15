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
    swal.fire({
        title: "Supprimer?",
        icon: "question",
        text: "Etes vous sur de vouloir supprimer cet element!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, Supprimer!",
        cancelButtonText: "Non, Annuler!",
        reverseButtons: true,
    }).then(
        function (e) {
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    type: "DELETE",
                    url: url,
                    data: { _token: CSRF_TOKEN },
                    dataType: "JSON",
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seco nds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    },
                });
            } else {
                e.dismiss;
            }
        },
        function (dismiss) {
            return false;
        }
    );
}

function restore(url) {
    swal.fire({
        title: "Restaurer?",
        icon: "question",
        text: "Etes vous sur de vouloir restauré cet element!",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, Restauré!",
        cancelButtonText: "Non, Annuler!",
        reverseButtons: true,
    }).then(
        function (e) {
            if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
                $.ajax({
                    type: "GET",
                    url: url,
                    data: { _token: CSRF_TOKEN },
                    dataType: "JSON",
                    success: function (results) {
                        if (results.success === true) {
                            swal.fire("Done!", results.message, "success");
                            // refresh page after 2 seconds
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            swal.fire("Error!", results.message, "error");
                        }
                    },
                });
            } else {
                e.dismiss;
            }
        },
        function (dismiss) {
            return false;
        }
    );
}

const loginButton = document.getElementById("loginButton");
const loader = document.getElementById("loader");
const loginForm = document.getElementById("loginForm");

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
                    event.preventDefault(); // Prevent default form submission only if validation fails
                    event.stopPropagation();
                } else {
                    const submitButton = form.querySelector('[type="submit"]');
                    const loader = form.querySelector(".loader");

                    // Disable submit button and show loader
                    submitButton.setAttribute("disabled", "disabled");
                    loader.style.display = "block";
                }

                form.classList.add("was-validated");
            },
            false
        );
    });
})();

// tom select function
document.addEventListener("DOMContentLoaded", function () {
    var el = document.querySelectorAll(".select-tags").forEach((el) => {
        window.TomSelect &&
            new TomSelect(el, {
                copyClassesToDropdown: false,
                dropdownClass: "dropdown-menu ts-dropdown",
                optionClass: "dropdown-item",
                controlInput: "<input>",
                render: {
                    item: function (data, escape) {
                        if (data.customProperties) {
                            return (
                                '<div><span class="dropdown-item-indicator">' +
                                data.customProperties +
                                "</span>" +
                                escape(data.text) +
                                "</div>"
                            );
                        }
                        return "<div>" + escape(data.text) + "</div>";
                    },
                    option: function (data, escape) {
                        if (data.customProperties) {
                            return (
                                '<div><span class="dropdown-item-indicator">' +
                                data.customProperties +
                                "</span>" +
                                escape(data.text) +
                                "</div>"
                            );
                        }
                        return "<div>" + escape(data.text) + "</div>";
                    },
                },
            });
    });
});

// datatable search function
$(document).ready(function () {
    $("#search-input").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        var matchedRows = $("#datatable tbody tr").filter(function () {
            return $(this).text().toLowerCase().indexOf(value) > -1;
        });
        $("#datatable tbody tr").not(matchedRows).hide();
        matchedRows.show();
        if (matchedRows.length == 0) {
            $("#no-results").show();
        } else {
            $("#no-results").hide();
        }
    });
});

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
