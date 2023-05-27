<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/general/general.css">
    <link rel="stylesheet" href="../../assets/lib/boostrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/c5b31b49c9.js" crossorigin="anonymous"></script>
    <title>Pengampu</title>

    <?php
    include_once("../db/connect.php");
    $sql_pengampu = "SELECT a.kode as kode," .
        "       b.kode_mk as `kode_mk`," .
        "       b.nama as `nama_mk`," .
        "       c.nidn as `kode_dosen`," .
        "       c.nama as  `nama_dosen`," .
        "       a.kelas as kelas," .
        "       a.semester as `semester` " .
        "FROM pengampu a " .
        "LEFT JOIN matakuliah b " .
        "ON a.kode_mk = b.kode_mk " .
        "LEFT JOIN dosen c " .
        "ON a.kode_dosen = c.nidn ";
    if (isset($_POST['search'])) {
        $searchkey = mysqli_real_escape_string($connect, $_POST['search-box']);
        $sql_pengampu .= " WHERE b.nama LIKE '%$searchkey%' OR c.nama LIKE '%$searchkey%'";
    }
    $result_pengampu = mysqli_query($connect, $sql_pengampu);
    $cur = 0;
    ?>
</head>

<body>
    <div class="wrapper d-flex">
        <div class="sidebars shadow" style="width: 320px;">
            <div class="s-wrapper vh-100  p-3">
                <div class="s-judul">
                    <h2>
                        BIVSA AZESK
                    </h2>
                </div>
                <hr class="border border-top border-2">
                <ul class="s-list nav mb-auto">
                    <li class="nav-item">
                        <a href="../index.php">
                            <i class="fa-solid fa-gauge"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="dosen.php">
                            <i class="fa-solid fa-chalkboard-user"></i>
                            Dosen
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#">
                            <i class="fa-solid fa-calendar-days"></i>
                            Jadwal Perkuliahan
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="matakuliah.php">
                            <i class="fa-solid fa-book"></i>
                            Mata kuliah
                        </a>
                    </li>
                    <li class="nav-item s-active">
                        <a href="pengampu.php">
                            <i class="fa-solid fa-person-chalkboard"></i>
                            Pengampu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="ruang.php">
                            <i class="fa-solid fa-school"></i>
                            Ruang
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="hari.php">
                            <i class="fa-solid fa-calendar-day"></i>
                            Hari
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="jam.php">
                            <i class="fa-solid fa-clock"></i>
                            Jam
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <main class="flex-grow-1 d-flex flex-column p-3">
            <?php
            if (isset($_GET['message'])) {
                $message = $_GET['message'];
                $state = $_GET['state'];
                if ($state == "failed") {
            ?>
                    <div class="alert alert-warning w-100 p-3">
                        <h5><?= $message ?></h5>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-success w-100 p-3">
                        <h5><?= $message ?></h5>
                    </div>
            <?php
                }
            }
            ?>
            <h3>Pengampu</h3>
            <div class="table-area p-3">
                <div class="ta-action d-flex justify-content-between">
                    <form action="pengampu.php" method="post">
                        <div class="taa-search input-group">
                            <div class="search-area form-outline">
                                <input type="text" name="search-box" id="search-box" class="form-control" placeholder="Cari Nama atau Kode">
                            </div>
                            <button type="submit" name="search" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                    <div class="taa-button">
                        <button class="btn btn-primary" onclick="showadd()">Tambah Data +</button>
                    </div>
                </div>
                <div class="ta-field">
                    <table class="table table-light table-bordered border-dark m-0">
                        <thead style="font-weight: 600;">
                            <th>Nama Matakuliah</th>
                            <th>Nama Dosen</th>
                            <th>Kelas</th>
                            <th>Tahun Akademik</th>
                            <th style="width:0.1px;">Action</th>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result_pengampu) == 0) {
                            ?>
                                <tr>
                                    <td colspan="5">
                                        Tidak Ada data
                                    </td>
                                </tr>
                                <?php
                            } else {
                                $batas = 10;
                                $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                                $halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

                                $previous = $halaman - 1;
                                $next = $halaman + 1;
                                $data = mysqli_query($connect, $sql_pengampu);
                                $jumlah_data = mysqli_num_rows($data);
                                $total_halaman = ceil($jumlah_data / $batas);
                                $sql_pengampu .= " LIMIT $halaman_awal, $batas";
                                $data_pengampu = mysqli_query($connect, $sql_pengampu);
                                $nomor = $halaman_awal + 1;
                                while ($d = mysqli_fetch_array($data_pengampu)) {
                                ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?php echo $d['nama_mk']; ?></td>
                                        <td style="vertical-align: middle;"><?php echo $d['nama_dosen']; ?></td>
                                        <td style="vertical-align: middle;"><?php echo $d['kelas']; ?></td>
                                        <td style="vertical-align: middle;"><?php echo $d['semester']; ?></td>
                                        <td style="vertical-align: middle;">
                                            <div class="d-flex gap-1">
                                                <a href="?cur=<?= $d['kode'] ?>"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                                <a href="../control/c.pengampu.php?kode=<?= $d['kode'] ?>&aksi=delete"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between">
                    <form action="pengampu.php" method="POST">
                        <button class="btn btn-dark" name="clear" type="submit">Clear Filter</button>

                    </form>
                    <ul class="pagination m-0">
                        <?php
                        if (mysqli_num_rows($result_pengampu) != 0) {
                        ?>
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman > 1) {
                                                        ?>href='?halaman=<?= $Previous ?>' ; <?php } ?>>Previous</a>
                            </li>
                            <?php
                            for ($x = 1; $x <= $total_halaman; $x++) {
                                if ($x == $halaman) {
                            ?>
                                    <li class="page-item active"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                                <?php } else {

                                ?>
                                    <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
                            <?php
                                }
                            }
                            ?>
                            <li class="page-item">
                                <a class="page-link" <?php if ($halaman < $total_halaman) {
                                                        ?>href='?halaman=<?= $next ?>' ; <?php } ?>>Next</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </main>
        <div class="input-area" id="input-area-add">
            <div class="ia-box">
                <div class="iab-close">
                    <button class="btn btn-transparent shadow-none" onclick="showadd()"><i class="fa-solid fa-xmark fa-xl"></i></button>
                </div>
                <div class="iab-input">
                    <h3 class="mb-3">Input Data Pengampu</h3>
                    <form action="../control/c.pengampu.php?aksi=add" method="post">
                        <div class="iab-field">
                            <label for="kode_mk" class="label-control">Kode Mata Kuliah</label>
                            <input type="text" name="kode_mk" id="kode_mk" class="form-control" placeholder="Masukan Kode Mata Kuliah">
                        </div>
                        <div class="iab-field">
                            <label for="kode_dosen" class="label-control">NIDN</label>
                            <input type="text" name="kode_dosen" id="kode_dosen" class="form-control" placeholder="Masukan Nomor Induk Dosen">
                        </div>
                        <div class="iab-field">
                            <label for="kelas" class="label-control">Kelas</label>
                            <input type="text" name="kelas" id="kelas" class="form-control" placeholder="Masukan Kelas">
                        </div>
                        <div class="iab-field">
                            <label for="semester" class="label-control">Semester</label>
                            <input type="text" name="semester" id="semester" class="form-control" placeholder="Semester">
                        </div>
                        <div class="iab-field">
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php

        if (isset($_GET['cur'])) {
            $cur = $_GET['cur'];
            include('../db/connect.php');
            $show = "SELECT * FROM pengampu WHERE kode='$cur'";
            $qr = mysqli_query($connect, $show);
            while ($data = mysqli_fetch_array($qr)) {
                $kode_mk = $data['kode_mk'];
                $kode_dosen = $data['kode_dosen'];
                $kelas = $data['kelas'];
                $semester = $data['semester'];
            };


        ?>
            <div class="input-area" style="display: flex;" id="input-area-del">
                <div class="ia-box">
                    <div class="iab-close">
                        <button class="btn btn-transparent shadow-none" onclick="showdel()"><i class="fa-solid fa-xmark fa-xl"></i></button>
                    </div>
                    <div class="iab-input">
                        <h3 class="mb-3">Edit Data pengampu</h3>
                        <form action="../control/c.pengampu.php?aksi=edit" method="post">
                            <input type="hidden" name="cur" id="cur" value="<?php echo $cur ?>">
                            <div class="iab-field">
                                <label for="kode_mk" class="label-control">Kode Mata Kuliah</label>
                                <input type="text" name="kode_mk" id="kode_mk" class="form-control" value="<?php echo $kode_mk ?>">
                            </div>
                            <div class="iab-field">
                                <label for="kode_dosen" class="label-control">Nomor Induk Dosen</label>
                                <input type="text" name="kode_dosen" id="kode_dosen" class="form-control" value="<?php echo $kode_dosen ?>">
                            </div>
                            <div class="iab-field">
                                <label for="kelas" class="label-control">sks</label>
                                <input type="text" name="kelas" id="kelas" class="form-control" value="<?php echo $kelas ?>">
                            </div>
                            <div class="iab-field">
                                <label for="semester" class="label-control">Semester</label>
                                <input type="number" name="semester" id="semester" class="form-control" value="<?php echo $semester ?>">
                            </div>
                            <div class="iab-field">
                                <input type="submit" class="btn btn-primary" value="Kirim">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</body>
<script src="../scripts/general.js"></script>

</html>