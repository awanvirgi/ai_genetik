<?php 
    require('koneksi.php');
    $showrekom = mysqli_query($koneksi,"SELECT * FROM product where recomended='yes'");
    // $showrekom = mysqli_query($koneksi,"SELECT * FROM product where recomended='yes'");
    // while ($list = mysqli_fetch_array($showrekom)) {
    //     echo $list['splash'];
    // }
    // while ($splash = mysqli_fetch_array($showrekom)) {
    //     echo $splash['splash'];
    // }


    

?>