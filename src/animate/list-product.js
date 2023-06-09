$(document).ready(
    function () {
    $("input:radio[name=drinklist]").click(function () {
        var value = $(this).val();
        var image_name = "../assets/img/product/" + value + "-splash.png";
        $('#productsplash').attr('src', image_name);
    });
});