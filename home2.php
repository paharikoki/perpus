<?php
session_start();
require_once './koneksi.php';
if (isset($_SESSION['user_id']) && $_SESSION['user_email'] ) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <nav class="sidebar">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="images/logo.png" alt="logo" />
                </span>
                <div class="text header-text">
                    <span class="main">Sistem </span>
                    <span class="sub">Perpustakaan</span>
                </div>
            </div>
        </header>

        <?php include 'menu.php'; ?>
    </nav>
    <main>
        <div class="header">
            <div class="header-left ">
                <div class="search-topbar">
                    <i class="bx bx-search icons"></i>
                    <input type="search" placeholder="Search..." />
                </div>
            </div>
            <div class="header-right">
                <div class="notification">
                    <i class="bx bx-bell icons"></i>
                    <span class="count">8</span>
                </div>
                <div class="profile">
                    <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['user_name']); ?>"
                        alt="profile" />
                    <div class="name">
                        <p><?php echo $_SESSION['user_name']; ?></p>
                        <span>Admin</span>
                    </div>
                    <i class="bx bx-chevron-down icons"></i>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="jumbotron">
                <h2 align="center">APLIKASI Perpustakaan Digital </h2>
                <p align="center">Universitas Negeri Malang</p>
                <p align="center">Selamat Datang<strong> <?php echo $_SESSION['user_name']; ?></strong></p>
            </div>
        </div>
        <!-- <div class="container">
            <div class="row">
                <h2 class="title-dashboard">Daftar Buku</h2>
            </div>
            <div class="row">
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (2).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">Ketika Cinta Bertasbih 2</p>
                            <div class="status-table">
                                <span class="completed">Tersedia</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Cinta</span>
                            <p class="author">Habiburrahman El-Shirazy</p>
                            <a href="#" class="btn">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (1).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">Bumi Manusia</p>
                            <div class="status-table">
                                <span class="borrowed">Dipinjam</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Fiksi</span>
                            <p class="author">Pramoedya Ananta Toer</p>
                            <a href="#" class="btn hidden">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (3).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">Perahu Kertas</p>
                            <div class="status-table">
                                <span class="borrowed">Dipinjam</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Fiksi</span>
                            <p class="author">Dee</p>
                            <a href="#" class="btn hidden">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (4).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">Bintang</p>
                            <div class="status-table">
                                <span class="completed">Tersedia</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Fiksi</span>
                            <p class="author">Tere Liye</p>
                            <a href="#" class="btn ">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (5).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">Bumi</p>
                            <div class="status-table">
                                <span class="completed">Tersedia</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Fiksi</span>
                            <p class="author">Tere Liye</p>
                            <a href="#" class="btn">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (6).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">Setangkup Bunga-Bunga Syairku</p>
                            <div class="status-table">
                                <span class="completed">Tersedia</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Cinta</span>
                            <p class="author">
                                Ike Herawati Dwi Cahyani</p>
                            <a href="#" class="btn ">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (7).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">Bersinar Meski Berbeda</p>
                            <div class="status-table">
                                <span class="completed">Tersedia</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Cinta</span>
                            <p class="author">Cut Aida Rusyiyah</p>
                            <a href="#" class="btn ">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
                <div class="book-card">
                    <div class="book-image">
                        <img src="images/cover (8).png" alt="Book Cover" />
                        <div class="book-cover-shadow"></div>
                    </div>
                    <div class="book-details">
                        <div class="book-row">
                            <p class="title">PANORAMA CINTA: Dari Cinta Diri Sampai Cinta Ilahi</p>
                            <div class="status-table">
                                <span class="borrowed">Dipinjam</span>
                            </div>
                        </div>
                        <div class="text-detail">
                            <span class="genre">Motivasi</span>
                            <p class="author">A. M. M. Hardjana</p>
                            <a href="#" class="btn hidden">Pinjam Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </main>
    <script src="js/script.js"></script>
</body>

</html>
<?php
}else{
    header("Location: index.php");
    exit();
    session_destroy();
}
?>