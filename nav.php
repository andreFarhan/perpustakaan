  <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="font-awesome/css/all.min.css">

<style type="text/css">
    .container {
        margin-top: 30px;
    }
    .dropdown-toggle,
    .dropdown-menu {
        border-radius: 0px !important;
    }
    .dropdown-item:hover {
        color: white;
        background-color: #0f4c81;
    }
    .btn-danger {
        width: 55%;
    }
    .dropdown:hover>.dropdown-menu {
      display: block;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #820000">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php if ($_SERVER['REQUEST_URI'] == '/perpustakaan/dashboard.php'): ?>
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i> Home</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php"><i class="fa fa-home"></i> Home</a>
        </li>
      <?php endif ?>
  <?php if (isset($_SESSION['id_user'])): ?>
    <?php if ($_SERVER['REQUEST_URI'] == '/perpustakaan/user_show.php' OR $_SERVER['REQUEST_URI'] == '/perpustakaan/user_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/perpustakaan/user_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i> User
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="user_show.php"><i class="fa fa-user"></i> User</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="user_tambah.php"><i class="fa fa-user-plus"></i> Tambah User</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-user"></i> User
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="user_show.php"><i class="fa fa-user"></i> User</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="user_tambah.php"><i class="fa fa-user-plus"></i> Tambah User</a>
      </div>
    </li>
    <?php endif ?>

     <?php if ($_SERVER['REQUEST_URI'] == '/perpustakaan/anggota_show.php' OR $_SERVER['REQUEST_URI'] == '/perpustakaan/anggota_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/perpustakaan/anggota_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-users"></i> Anggota
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="anggota_show.php"><i class="fa fa-users"></i> Anggota</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="anggota_tambah.php"><i class="fa fa-user-plus"></i> Tambah Anggota</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-users"></i> Anggota
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="anggota_show.php"><i class="fa fa-users"></i> Anggota</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="anggota_tambah.php"><i class="fa fa-user-plus"></i> Tambah Anggota</a>
      </div>
    </li>
    <?php endif ?>

    <?php if ($_SERVER['REQUEST_URI'] == '/perpustakaan/buku_show.php' OR $_SERVER['REQUEST_URI'] == '/perpustakaan/buku_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/perpustakaan/buku_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-book"></i> Buku
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="buku_show.php"><i class="fa fa-book"></i> Buku</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="buku_tambah.php"><i class="fa fa-book"></i><strong>+</strong> Tambah Buku</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-book"></i> Buku
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="buku_show.php"><i class="fa fa-book"></i> Buku</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="buku_tambah.php"><i class="fa fa-book"></i><strong>+</strong> Tambah Buku</a>
      </div>
    </li>
    <?php endif ?>
    
    <?php if ($_SERVER['REQUEST_URI'] == '/perpustakaan/transaksi_show.php' OR $_SERVER['REQUEST_URI'] == '/perpustakaan/transaksi_tambah.php' OR $_SERVER['SCRIPT_NAME'] == '/perpustakaan/transaksi_ubah.php'): ?>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-shopping-cart"></i> transaksi
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="transaksi_show.php"><i class="fa fa-shopping-cart"></i> transaksi</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="transaksi_tambah.php"><i class="fa fa-cart-plus"></i> Tambah transaksi</a>
      </div>
    </li>
    <?php else: ?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-shopping-cart"></i> transaksi
      </a>
      <div class="dropdown-menu mt-n2" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="transaksi_show.php"><i class="fa fa-shopping-cart"></i> transaksi</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="transaksi_tambah.php"><i class="fa fa-cart-plus"></i> Tambah transaksi</a>
      </div>
    </li>
    <?php endif ?>
  <?php else: ?>
    <?php if ($_SERVER['REQUEST_URI'] == '/perpustakaan/buku_show.php'): ?>
        <li class="nav-item active">
          <a class="nav-link" href="buku_show.php"><i class="fa fa-book"></i> Daftar Buku</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="buku_show.php"><i class="fa fa-book"></i> Daftar Buku</a>
        </li>
    <?php endif ?>
    
    <?php if ($_SERVER['REQUEST_URI'] == '/perpustakaan/transaksi_show.php'): ?>
        <li class="nav-item active">
          <a class="nav-link" href="transaksi_show.php"><i class="fa fa-shopping-cart"></i> Daftar Transaksi</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="transaksi_show.php"><i class="fa fa-shopping-cart"></i> Daftar Transaksi</a>
        </li>
    <?php endif ?>
  <?php endif ?>

      <li class="nav-item">
        <a onclick="return confirm('Apakah anda ingin keluar?')" class="nav-link" href="logout.php"><i class="fa fa-door-open"></i> Keluar</a>
      </li>
    </ul>
      <?php 
        $username = ucwords($_SESSION['username']);
       ?>
       <?php if (isset($_SESSION['id_user'])): ?>
          <b class="mr-sm-2 mb-n1 text-white">Admin, <?= $username; ?></b>
        <?php else: ?>
          <b class="mr-sm-2 mb-n1 text-white"><?= $username; ?></b>
       <?php endif ?>
  </div>
</nav>