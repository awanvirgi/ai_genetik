<?php
include_once('../db/connect.php');
$kode = $_GET['kode'];
$nidn = $_POST['nidn'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$telp = $_POST['tlp'];
$aksi = $_GET['aksi'];
$cur = $_POST['cur'];

if ($aksi == 'add') {
    $sql_nidn = "SELECT * FROM dosen WHERE nidn = '$nidn'";
    $cek_nidn = mysqli_query($connect, $sql_nidn);

    if (mysqli_num_rows($cek_nidn) > 0) {
        $state = "failed";
        $message = "NIDN sudah tersedia, Data gagal ditambahkan";
    } else {
        $sql_addos = "INSERT INTO dosen (nidn,nama,alamat,telp) VALUES ('$nidn','$nama','$alamat','$telp')";
        mysqli_query($connect, $sql_addos);
        $state = "success";
        $message = "Data Berhasil Ditambahkan";
    }
    $message = urlencode($message);
    header("Location:../views/dosen.php?message={$message}&state=$state");
} else if ($aksi == 'edit') {
    $sql_editdos = "UPDATE dosen SET nidn='$nidn',nama='$nama',alamat='$alamat',telp='$telp' WHERE kode='$cur'";
    mysqli_query($connect, $sql_editdos);
    $message = "Data berhasil di edit";
    $state = "succes";
    header("Location:../views/dosen.php?message={$message}&state=$state");
}else if($aksi == 'delete'){
    $sql_deldos="DELETE FROM dosen WHERE kode='$kode'";
    mysqli_query($connect,$sql_deldos);
    $message="Berhasil Dihapus";
    $state="succes";
    header("Location:../views/dosen.php?message={$message}&state=$state");   
}
?>