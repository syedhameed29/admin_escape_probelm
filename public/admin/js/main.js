const $button = document.querySelector("#sidebar-toggle");
const $wrapper = document.querySelector("#wrapper");

$button.addEventListener("click", (e) => {
    e.preventDefault();
    $wrapper.classList.toggle("toggled");
});

//form country select
$(document).on("change", "#countryval", function () {
    jQuery.ajax({
        url: "/selectcountry",
        type: "GET",
        dataType: "json",
        data: $("#countryval").serializeArray(),
        success: function ($state) {
            $("#stateval").empty();
            $("#stateval").prepend("<option value=''>Choose State...</option>");
            $("#districtval").empty();
            $("#districtval").prepend("<option value=''>Choose...</option>");
            $("#stateval").append($state);
        },
    });
});

//form state select
$(document).on("change", "#stateval", function () {
    jQuery.ajax({
        url: "/selectstate",
        type: "GET",
        dataType: "json",
        data: $("#stateval").serializeArray(),
        success: function ($district) {
            $("#districtval").empty();
            $("#districtval").prepend(
                "<option value=''>Choose District...</option>"
            );
            $("#districtval").append($district);
        },
    });
});
