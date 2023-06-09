<?php
$t = 1;
foreach ($data as $splash) {
?>
    <img src="../assets/img/product/<?php echo $splash['splash'] ?>" class="img-fluid" alt="" id="productsplash" name="productsplash" <?php echo $t !== 1 ? "style='display: none;'" : "style='display: flex;'" ?>>
<?php
    $t++;
}
?>
<!-- 
$(document).ready(
    function () {
    $("input:radio[name=drinklist]").click(function () {
        var value = $(this).val();
        var image_name;
        if (value == 'original') {
            image_name = "../../assets/img/splash-ori.png";
        }if(value == 'guava') {
            image_name = "../../assets/img/splash-guava.png";
        }if(value == 'coklat') {
            image_name = "../../assets/img/splash-coklat.png";
        }if(value == 'thai') {
            image_name = "../../assets/img/splash-thai.png";
        }
        $('#productsplash').attr('src', image_name);
    });
}); -->