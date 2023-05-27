<?php
include_once('../db/connect.php');
$kode = $_GET['kode'];
$cur = $_POST['cur'];
$kode_mk = $_POST['kode_mk'];
$nama = $_POST['nama'];
$sks = $_POST['sks'];
$semester = $_POST['semester'];
$aktif = $_POST['aktif'];
$jenis = $_POST['jenis'];
$aksi = $_GET['aksi'];


if ($aksi == "add") {
    $sql_kode_mk = "SELECT * FROM matakuliah WHERE kode_mk = '$kode_mk'";
    $cek_kode_mk = mysqli_query($connect, $sql_kode_mk);
    if (mysqli_num_rows($cek_kode_mk) > 0) {
        $state = "failed";
        $message = "Kode Mata Kuliah sudah tersedia, Data gagal ditambahkan";
    } else {
        $sql_addmat = "INSERT INTO matakuliah (kode_mk,nama,sks,semester) VALUES ('$kode_mk','$nama','$sks','$semester')";
        mysqli_query($connect, $sql_addmat);
        $state = "success";
        $message = "Data Berhasil Ditambahkan";
    }
    $message = urlencode($message);
    header("Location:../views/matakuliah.php?message={$message}&state=$state");
} else if ($aksi == "edit") {
    $sql_dos = "UPDATE matakuliah SET nama='$nama',sks='$sks',semester='$semester',aktif='$aktif',jenis='$jenis' WHERE kode='$cur'";
    mysqli_query($connect, $sql_dos);
    $message = "Data berhasil di Edit ";
    $state = "succes";
    header("Location:../views/matakuliah.php?message={$message}&state=$state");
} else if ($aksi == "delete") {
    $sql_delmat = "DELETE FROM matakuliah WHERE kode='$kode'";
    mysqli_query($connect, $sql_delmat);
    $message = "Berhasil Dihapus";
    $state = "succes";
    header("Location:../views/matakuliah.php?message={$message}&state=$state");
}
?>