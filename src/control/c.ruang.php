<?php
include_once('../db/connect.php');
$kode_ruang = $_POST['kode_ruang'];
echo $kode_ruang;
$kode = $_GET['kode'];
$nama = $_POST['nama'];
$kapasitas = $_POST['kapasitas'];
$jenis = $_POST['jenis'];
$aksi = $_GET['aksi'];
$cur = $_POST['cur'];

if ($aksi == 'add') {
    $sql_kode = "SELECT * FROM ruang WHERE kode_ruang = '$kode_ruang'";
    $cek_kode = mysqli_query($connect, $sql_kode);

    if (mysqli_num_rows($cek_kode) > 0) {
        $state = "failed";
        $message = "Kode sudah tersedia, Data gagal ditambahkan";
    } else {
        $sql_adrua = "INSERT INTO ruang (kode_ruang,nama,kapasitas,jenis) VALUES ('$kode_ruang','$nama','$kapasitas','$jenis')";
        mysqli_query($connect, $sql_adrua);
        $state = "success";
        $message = "Data Berhasil Ditambahkan";
    }
    $message = urlencode($message);
    header("Location:../views/ruang.php?message={$message}&state=$state");
} else if ($aksi == 'edit') {
    $sql_editrua = "UPDATE ruang SET nama='$nama',kapasitas='$kapasitas',jenis='$jenis' WHERE kode='$cur'";
    mysqli_query($connect, $sql_editrua);
    $message = "Data berhasil di edit";
    $state = "succes";
    header("Location:../views/ruang.php?message={$message}&state=$state");
}else if($aksi == 'delete'){
    $sql_delrua="DELETE FROM ruang WHERE kode='$kode'";
    mysqli_query($connect,$sql_delrua);
    $message="Berhasil Dihapus";
    $state="succes";
    header("Location:../views/ruang.php?message={$message}&state=$state");   
}
?>