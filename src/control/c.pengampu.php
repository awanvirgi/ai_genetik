<?php
include_once('../db/connect.php');
$kode = $_GET['kode'];
$kode_mk = $_POST['kode_mk'];
$kode_dosen = $_POST['kode_dosen'];
$kelas = $_POST['kelas'];
$semester = $_POST['semester'];
$aksi = $_GET['aksi'];
$cur = $_POST['cur'];


if ($aksi == 'add') {
    $sql_addpen = "INSERT INTO pengampu (kode_mk,kode_dosen,kelas,semester) VALUES ('$kode_mk','$kode_dosen','$kelas','$semester')";
    $qr_addpen = mysqli_query($connect,$sql_addpen);

    if (!$qr_addpen) {
        $state = "failed";
        $message = "Data Pengampu sudah tersedia, Data gagal ditambahkan";
    } else {
        $state = "success";
        $message = "Data Berhasil Ditambahkan";
    }
    $message = urlencode($message);
    header("Location:../views/pengampu.php?message={$message}&state=$state");
} else if ($aksi == 'edit') {
    $sql_editpen = "UPDATE pengampu SET kode_mk='$kode_mk',kode_dosen='$kode_dosen',kelas='$kelas',semester='$semester' WHERE kode='$cur'";
    mysqli_query($connect, $sql_editpen);
    $message = "Data berhasil di edit";
    $state = "succes";
    header("Location:../views/pengampu.php?message={$message}&state=$state");
}else if($aksi == 'delete'){
    $sql_delpen="DELETE FROM pengampu WHERE kode='$kode'";
    mysqli_query($connect,$sql_delpen);
    $message="Berhasil Dihapus";
    $state="succes";
    header("Location:../views/pengampu.php?message={$message}&state=$state");   
}
?>