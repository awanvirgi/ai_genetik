<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/general/general.css">
    <link rel="stylesheet" href="../../assets/lib/boostrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/c5b31b49c9.js" crossorigin="anonymous"></script>
    <title>Dosen</title>

    <?php
    include_once("../db/connect.php");
    $sql_dosen = "SELECT * FROM dosen";
    if (isset($_POST['search'])) {
        $searchkey = mysqli_real_escape_string($connect, $_POST['search-box']);
        $sql_dosen .= " WHERE nidn LIKE '%$searchkey%' OR nama LIKE '%$searchkey%'";
    }
    $result_dosen = mysqli_query($connect, $sql_dosen);
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
                        <a href="dosen.php s-active">
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
                    <li class="nav-item">
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
            <h3>Mata Kuliah</h3>
            <div class="table-area p-3">
                <div class="ta-action d-flex justify-content-between">
                    <form action="dosen.php" method="post">
                        <div class="taa-search input-group">
                            <div class="search-area form-outline">
                                <input type="text" name="search-box" id="search-box" class="form-control" placeholder="Cari Nama atau NIDN ">
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
                            <th>NIDN</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telp</th>
                            <th style="width:0.1px;">Action</th>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result_dosen) == 0) {
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
                                $data = mysqli_query($connect, $sql_dosen);
                                $jumlah_data = mysqli_num_rows($data);
                                $total_halaman = ceil($jumlah_data / $batas);
                                $sql_dosen .= " LIMIT $halaman_awal, $batas";
                                $data_dosen = mysqli_query($connect, $sql_dosen);
                                $nomor = $halaman_awal + 1;
                                while ($d = mysqli_fetch_array($data_dosen)) {
                                ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?php echo $d['nidn']; ?></td>
                                        <td style="vertical-align: middle;"><?php echo $d['nama']; ?></td>
                                        <td style="vertical-align: middle;"><?php echo $d['alamat']; ?></td>
                                        <td style="vertical-align: middle;"><?php echo $d['telp']; ?></td>
                                        <td style="vertical-align: middle;">
                                            <div class="d-flex gap-1">
                                                <a href="?cur=<?= $d['kode'] ?>"><button class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                                <a href="../control/c.dosen.php?kode=<?= $d['kode'] ?>&aksi=delete"><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                                                <a href=""></a>
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
                    <form action="dosen.php" method="POST">
                        <button class="btn btn-dark" name="clear" type="submit">Clear Filter</button>

                    </form>
                    <ul class="pagination m-0">
                        <?php
                        if (mysqli_num_rows($result_dosen) != 0) {
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
                    <h3 class="mb-3">Input Data Dosen</h3>
                    <form action="../control/c.dosen.php?aksi=add" method="post">
                        <div class="iab-field">
                            <label for="nidn" class="label-control">NIDN</label>
                            <input type="text" name="nidn" id="nidn" class="form-control" value="">
                        </div>
                        <div class="iab-field">
                            <label for="nama" class="label-control">Nama Dosen</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Dosen">
                        </div>
                        <div class="iab-field">
                            <label for="alamat" class="label-control">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="4" class="form-control" placeholder="Masukan Alamat"></textarea>
                        </div>
                        <div class="iab-field">
                            <label for="tlp" class="label-control">Nomor Telepon</label>
                            <input type="number" name="tlp" id="tlp" class="form-control" placeholder="Masukan Nomor Telepon">
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
            $show = "SELECT * FROM dosen WHERE kode='$cur'";
            $qr = mysqli_query($connect, $show);
            while ($data = mysqli_fetch_array($qr)) {
                $nidn = $data['nidn'];
                $nama = $data['nama'];
                $alamat = $data['alamat'];
                $telp = $data['telp'];
            };
        ?>
            <div class="input-area" style="display: flex;" id="input-area-del">
                <div class="ia-box">
                    <div class="iab-close">
                        <button class="btn btn-transparent shadow-none" onclick="showdel()"><i class="fa-solid fa-xmark fa-xl"></i></button>
                    </div>
                    <div class="iab-input">
                        <h3 class="mb-3">Edit Data Dosen</h3>
                        <form action="../control/c.dosen.php?aksi=edit" method="post">
                            <input type="hidden" name="cur" id="cur" value="<?php echo $cur ?>">
                            <div class="iab-field">
                                <label for="nidn" class="label-control">NIDN</label>
                                <input type="text" name="nidn" id="nidn" class="form-control" value="<?php echo $nidn ?>">
                            </div>
                            <div class="iab-field">
                                <label for="nama" class="label-control">Nama Dosen</label>
                                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo $nama ?>">
                            </div>
                            <div class="iab-field">
                                <label for="alamat" class="label-control">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="4" class="form-control"><?php echo $alamat ?></textarea>
                            </div>
                            <div class="iab-field">
                                <label for="tlp" class="label-control">Nomor Telepon</label>
                                <input type="number" name="tlp" id="tlp" class="form-control" value="<?php echo $telp ?>">
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