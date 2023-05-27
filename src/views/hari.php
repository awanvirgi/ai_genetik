<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/general/general.css">
    <link rel="stylesheet" href="../../assets/lib/boostrap/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/c5b31b49c9.js" crossorigin="anonymous"></script>
    <title>Hari</title>

    <?php
    include_once("../db/connect.php");
    $sql_hari = "SELECT * FROM hari";
    if (isset($_POST['search'])) {
        $searchkey = mysqli_real_escape_string($connect, $_POST['search-box']);
        $sql_hari .= " WHERE b.nama LIKE '%$searchkey%' OR c.nama LIKE '%$searchkey%'";
    }
    $result_hari = mysqli_query($connect, $sql_hari);
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
                    <li class="nav-item s-active">
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
            <h3>Hari</h3>
            <div class="table-area p-3">
                <div class="ta-action d-flex justify-content-between">
                    <form action="hari.php" method="post">
                        <div class="taa-search input-group">
                            <div class="search-area form-outline">
                                <input type="text" name="search-box" id="search-box" class="form-control" placeholder="Cari Nama atau Kode">
                            </div>
                            <button type="submit" name="search" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </form>
                </div>
                <div class="ta-field">
                    <table class="table table-light table-bordered border-dark m-0">
                        <thead style="font-weight: 600;">
                            <th>No</th>
                            <th>Nama Hari</th>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result_hari) == 0) {
                            ?>
                                <tr>
                                    <td colspan="2">
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
                                $data = mysqli_query($connect, $sql_hari);
                                $jumlah_data = mysqli_num_rows($data);
                                $total_halaman = ceil($jumlah_data / $batas);
                                $sql_hari .= " LIMIT $halaman_awal, $batas";
                                $data_hari = mysqli_query($connect, $sql_hari);
                                $nomor = $halaman_awal + 1;
                                while ($d = mysqli_fetch_array($data_hari)) {
                                ?>
                                    <tr>
                                        <td style="vertical-align: middle;"><?php echo $d['kode']; ?></td>
                                        <td style="vertical-align: middle;"><?php echo $d['nama']; ?></td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <ul class="pagination m-0">
                        <?php
                        if (mysqli_num_rows($result_hari) != 0) {
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
    </div>
</body>
<script src="../scripts/general.js"></script>

</html>