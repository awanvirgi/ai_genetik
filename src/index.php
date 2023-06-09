<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require "control/c.index.php";
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <title>Teh Poci</title>
</head>

<body>
    <div class="wrapper">
        <header>
            <nav>
                <div class="nav-left">
                    <div class="n-img-wrap">
                        <img src="../assets/img/logo-poci.png" alt="logo">
                    </div>
                </div>
                <div class="nav-right">
                    <ul class="nav">
                        <li class="nav-item"><a href="index.html">Home</a></li>
                        <li class="nav-item"><a href="view/product.html">Products</a></li>
                        <li class="nav-item"><a href="">About Us</a></li>
                        <li class="nav-item"><a href="">Contact Us</a></li>
                    </ul>
                </div>
            </nav>
            <div class="header-content">
                <div class="hc-left">
                    <div class="hcl-wrap">
                        <img src="../assets/img/splash1.png" alt="splash">
                    </div>
                </div>
                <div class="hc-right">
                    <div class="hcr-wrap">
                        <h1>JELAJAHI SENSASI BARU DAN KENIKMATAN DENGAN TEH POCI</h1>
                        <a href="#footer"><button class="btn">Ingin Berjualan??</button></a>
                    </div>
                </div>
        </header>
        <main id="product">
            <div class="main-wrap">
                <div class="list-warp">
                    <div class="main-list">
                        <?php
                        $data = $showrekom->fetch_all(MYSQLI_ASSOC);
                        $r = 1;
                        foreach ($data as $list) {
                            if($r===1){
                                $first = $list['splash'];
                            }
                        ?>
                            <input type="radio" value="<?php echo $list['nama'] ?>" name="drinklist" id="<?php echo $list['nama'] ?>" <?php if ($r === 1) { ?> checked <?php } ?>>
                            <label for="<?php echo $list['nama'] ?>" class="box-list">
                                <img src="../assets/img/product/<?php echo $list['thumbnail'] ?>" alt="<?php echo $list['nama'] ?>" class="img-fluid list-item">
                            </label>
                        <?php
                            $r++;
                        }
                        ?>
                    </div>
                </div>

                <div class="main-content">
                    <div class="mc-left">
                        <h2>TEMUKAN KENIKMATAN TEH INSTAN YANG TAK TERTANDINGI!</h2>
                        <p>Dengan Es Teh Poci,Anda dapat menikmati teh instan berkualitas tinggi dengan banyak varian
                            rasa yang memikat, dan praktik disajikan!</p>
                    </div>
                    <div class="mc-center">
                        <div class="mcc-wrap">
                            <img src="../assets/img/product/<?php echo $first?>" class="img-fluid" alt="" id="productsplash" name="productsplash">
                        </div>
                    </div>
                    <div class="mc-right">
                        <h2>SEPERTI JATUH CINTA ES TEH POCI PUNYA BANYAK RASA</h2>
                        <p>Banyak Varian dan kombinasi rasa yang bisa dinikmati bagi kamu yang suka dengan hal yang baru
                            setiap harinya</p>
                    </div>
                </div>
            </div>
        </main>
        <main>
            <div class="main-content2">
                <div class="mc2-header">
                    <h2>Berbagai Paket yang bisa kamu pilih!</h2>
                </div>
                <div class="mc2-content">
                    <div class="sub-box box1">
                        <h3>Paket Hemat</h3>
                        Terdiri Dari
                        <ul>
                            <li>Meja dan Mesin press</li>
                            <li>Arizona 20 lt</li>
                            <li>Porta 10 lt</li>
                            <li>Saringan</li>
                            <li>Sodet Kayu</li>
                            <li>Centang Es</li>
                            <li>Teko Listrik</li>
                            <li>Cooler box</li>
                        </ul>
                        <h3>Rp.3.000.000</h3>
                    </div>
                    <div class="sub-box box2">
                        <h3>Paket Reguler</h3>
                        Terdiri Dari
                        <ul>
                            <li>Meja Reguler</li>
                            <li>Mesin Press</li>
                            <li>Arizona 20 lt</li>
                            <li>Porta 10 lt</li>
                            <li>Saringan</li>
                            <li>Sodet Kayu</li>
                            <li>Centang Es</li>
                            <li>Teko Listrik</li>
                            <li>Cooler box</li>
                        </ul>
                        <h3>Rp.5.000.000</h3>
                    </div>
                    <div class="sub-box box3">
                        <h3>Paket Besar</h3>
                        Terdiri Dari
                        <ul>
                            <li>Meja Besar</li>
                            <li>Mesin Press</li>
                            <li>Arizona 20 lt</li>
                            <li>Porta 10 lt</li>
                            <li>Saringan</li>
                            <li>Sodet Kayu</li>
                            <li>Centang Es</li>
                            <li>Teko Listrik</li>
                            <li>Cooler box</li>
                        </ul>
                        <h3>Rp.7.000.000</h3>
                    </div>
                </div>

            </div>
        </main>
        <footer id="footer">
            <div class="footer-wrap">
                <div class="f-left">
                    <form action="" method="post">
                        <div class="formbox">
                            <div class="input-wrap mb-4">
                                <h3 class="text-dark">Daftar</h3>
                            </div>
                            <div class="input-wrap">
                                <label for="nama" style="color: black;" class="label-control">Nama</label>
                                <input type="nama" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Anda" required>
                            </div>
                            <div class="input-wrap">
                                <label for="email" style="color: black;" class="label-control">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Masukan Email Anda" required>
                            </div>
                            <div class="input-wrap">
                                <label for="no_wa" style="color: black;" class="label-control">Nomor Whatsapp</label>
                                <input type="no_wa" name="no_wa" id="no_wa" class="form-control" placeholder="Masukan No Whatsapp Anda" required>
                            </div>
                            <div class="input-wrap">
                                <label for="alamat" style="color: black;" class="label-control">Alamat</label>
                                <textarea type="alamat" name="alamat" id="alamat" class="form-control" rows="3" placeholder="Masukan Alamat Anda" required></textarea>
                            </div>
                            <div class="input-wrap">
                                <label for="paket" style="color: black;" class="label-control">Paket</label>
                                <select name="paket" id="paket" class="form-control">
                                    <option value="p-hemat">Paket Hemat : RP.3.000.000</option>
                                    <option value="p-hemat">Paket Regular : RP.5.000.000</option>
                                    <option value="p-hemat">Paket Besar : RP.7.000.000</option>
                                </select>
                            </div>
                            <div class="input-wrap text-dark d-flex gap-1 align-middle" style="font-size: 10px;">
                                <input type="checkbox" name="terms" required>
                                Saya menyetujui syarat dan <a href="" style="text-decoration: underline!important;" class="text-primary">ketentuan dan kebijakan privasi</a> yang berlaku
                            </div>
                            <div class="input-wrap d-flex justify-content-center mt-3">
                                <button type="submit" class="btn px-3">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="f-right">
                    <div class="fr-wrap">
                        <h1>Tertarik Menjadi Mitra Official Kami?</h1>
                        <p>Bergabung lah dengan jutaan pecinta teh yang memilih Teh Poci Sebagai minuman teh Instan
                            Terbaik!!</p>
                    </div>
                </div>
            </div>
        </footer>
        <div class="copyright bg-dark h-100 text-center">
            Created by : Riezky Fauzi, Alfian ,Virgiawan Sanria
        </div>
    </div>
</body>
<script src="animate/list-product.js"></script>

</html>