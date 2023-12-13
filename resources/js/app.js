import "./bootstrap";
import "@tabler/core";
import TomSelect from "tom-select";
Window.TomSelect = TomSelect;

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".select-tags").forEach((el) => {
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

// import Alpine from "alpinejs";
// window.Alpine = Alpine;
// Alpine.start();
