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

function deleteConfirmation(url, title, message, confirmText, cancelText) {
    swal.fire({
        title: title,
        icon: "question",
        text: message,
        type: "warning",
        showCancelButton: true,
        confirmButtonText: confirmText,
        cancelButtonText: cancelText,
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

document.addEventListener("DOMContentLoaded", function () {
    var el = document.querySelector(".select-tags");
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
