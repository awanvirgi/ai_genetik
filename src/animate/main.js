$(document).ready(
    function () {
    $("input:radio[name=drinklist]").click(function () {
        var value = $(this).val();
        var image_name = "../assets/img/product" + value + ".png";
        $('#productsplash').attr('src', image_name);
    });
});