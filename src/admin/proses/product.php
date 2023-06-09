<?php
require('../../control/koneksi.php');
$nama = $_POST['nama'];
$recom = $_POST['recom'];
if (!$rekom) {
    $rekom = 'no';
}
$aksi = $_POST['aksi'];
$thumb = $_FILES['thumb']["name"];
$tmp_thumb = $_FILES['thumb']['tmp_name'];
$typethumb = strtolower(pathinfo($thumb, PATHINFO_EXTENSION));

$splash = $_FILES['splash']["name"];
$tmp_splash = $_FILES['splash']['tmp_name'];
$typetsplash = strtolower(pathinfo($splash, PATHINFO_EXTENSION));

if ($aksi === 'add') {
    $uploadok = 1;
    $state = "failed";
    if (!getimagesize($tmp_splash) | !getimagesize($tmp_thumb)) {
        $message = "Masukan File berupa gambar!";
        $uploadok = 0;
    }
    $target_dir = "../../../assets/img/product/";
    $newthumb = $nama . "-list." . $typethumb;
    $move_thumb = $target_dir . $newthumb;
    $newsplash = $nama . "-splash." . $typetsplash;
    $move_splash = $target_dir . $newsplash;
    if (file_exists($move_thumb) | file_exists($move_splash)) {
        $message = "Maaf FIle sudah ada";
        $uploadok = 0;
    }
    if ($uploadok === 1) {
        $insert = "INSERT INTO product(nama,splash,thumbnail,recomended) VALUES ('$nama','$newsplash','$newthumb','$recom')";
        $query = mysqli_query($koneksi, $insert);
        if ($query) {
            move_uploaded_file($tmp_thumb, $move_thumb);
            move_uploaded_file($tmp_splash, $move_splash);
            $message = "Product Berhasil ditambahkan";
            $state = "success";
        }else{
            $message = "Product gagal Ditambahkan";
        }
    }
    $message = urlencode($message);
    header("location:../add-product.php?message={$message}&state=$state");
}
