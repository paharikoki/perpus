<?php
if( !empty( $_SESSION['user_id'] ) ){
?>
<!-- Fixed navbar -->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="./index.php">Taman Pustaka</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Anggota
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./index.php?hlm=anggota">Daftar Anggota</a></li>
                        <li><a class="dropdown-item" href="./index.php?hlm=anggota&aksi=baru">Tambah Anggota</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Buku
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./index.php?hlm=buku">Daftar Buku</a></li>
                        <li><a class="dropdown-item" href="./index.php?hlm=buku&aksi=baru">Tambah Buku</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Transaksi
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./index.php?hlm=pinjam">Daftar Peminjama Buku</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./index.php?hlm=pinjam-buku">Peminjaman Buku</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./index.php?hlm=kunjungan">Kunjungan</a>
                </li>
            </ul>
            <div class="nav-item dropdown">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Hai! <?php echo $_SESSION['user_name']; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<?php
} else {
	header("Location: ./");
	die();
}
?>