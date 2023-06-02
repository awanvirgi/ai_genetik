$(document).ready(
    function () {
    $("input:radio[name=drinklist]").click(function () {
        var value = $(this).val();
        var image_name;
        if (value == 'original') {
            image_name = "../assets/img/splash-ori.png";
        } else if(value == 'guava') {
            image_name = "../assets/img/splash-guava.png";
        }else if(value == 'coklat') {
            image_name = "../assets/img/splash-coklat.png";
        }else if(value == 'thai') {
            image_name = "../assets/img/splash-thai.png";
        }
        $('#productsplash').attr('src', image_name);
    });
});