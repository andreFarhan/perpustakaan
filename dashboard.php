<?php 
    include 'functions.php';

    //cek login
    if ($_SESSION['login'] == 0) {
        header("Location: login_form.php");
    }

    if (isset($_SESSION['nama_user'])) {
        $nama = ucwords($_SESSION['nama_user']);
    }

    if (isset($_SESSION['nama_anggota'])) {
        $nama = ucwords($_SESSION['nama_anggota']);
    }

    $sql = "SELECT * FROM tb_transaksi
    INNER JOIN tb_buku ON tb_transaksi.id_buku = tb_buku.id_buku
    INNER JOIN tb_user ON tb_transaksi.id_user = tb_user.id_user
   
    ORDER BY id_transaksi DESC";
    $eksekusi = mysqli_query($koneksi, $sql);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management</title>
    <link rel="icon" href="img/logo-perpustakaan.png">
</head>
<body>
    <?php include 'nav.php'; ?>

    <div class="container mt-3">
        <h2></h2>
    <div class="alert alert-info text-center">
        <h4><b>Selamat Datang <b><?= $nama; ?></b></b></h4>
    </div>
            <h4>Beranda</h4>
            
            <div class="row">
                
                <div class="col mx-1 text-white bg-info rounded pt-2 pb-2">
                    <h1>
                        <i class="fa fa-book"></i>
                        <span class="pull-right">
                            <?php 
                                $sql_transaksi = "SELECT *, count(tb_transaksi.id_transaksi) as jml_transaksi FROM tb_transaksi";
                                $eksekusi_jml_transaksi = mysqli_query($koneksi, $sql_transaksi);
                                $data_jml_transaksi = mysqli_fetch_assoc($eksekusi_jml_transaksi);
                                echo $data_jml_transaksi['jml_transaksi'];
                            ?>
                        </span>
                    </h1>
                        <div>Jumlah Transaksi</div>
                </div>      
            </div>
               
</div>
    
</body>

<?php include 'footer.php'; ?>

</html>