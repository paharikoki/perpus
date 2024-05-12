<?php
session_start();
require_once '../koneksi.php';
if (isset($_SESSION['user_id']) && $_SESSION['user_email'] ) {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
    .h-home {
        height: 30vh;
    }

    .bg-home {
        background-image: url('../images/bglogin.jpg');
        background-size: cover;
        background-position: center;
        position: relative;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(128, 0, 128, 0.5);
        /* Warna ungu dengan opasitas 50% */
    }
    </style>
</head>

<body>
    <?php 
        include 'menu.php';
    ?>
    <main class="d-flex justify-content-center align-items-center ">
        <div class="col">
            <div class="w-100 bg-warning h-home bg-home position-relative">
                <div class="overlay"></div>
                <div class="text-center p-5 position-relative text-white">
                    <div class="content">
                        <h2 class="fs-2">Sistem Perpustakaan Taman Pustaka</h2>
                        <p class="lead">Universitas Negeri Malang</p>
                        <p>Selamat Datang <strong><?php echo $_SESSION['user_name']; ?></strong></p>
                    </div>
                </div>
            </div>

            <div class="container my-4 ">
                <?php
            if( isset($_REQUEST['hlm'])){
                $hlm = $_REQUEST['hlm'];
                switch ($hlm) {
                    case 'buku':
                        include './buku.php';
                        break;
                    case 'anggota':
                        include './anggota.php';
                        break;
                    case 'pinjam-buku':
                        include './pinjam_buku.php';
                        break;
                    case 'pinjam':
                        include './pinjam.php';
                        break;
                    case 'kunjungan':
                        include './kunjungan.php';
                        break;
                    default:
                        break;
                }
            }else{
                ?>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-3 border">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Kunjungan Hari Ini</h5>
                                <p class="card-text">
                                    <?php
                                    $sql = "SELECT COUNT(*) AS today_visits FROM tb_kunjungan WHERE DATE(waktu) = CURDATE()";
                                    $result = mysqli_query($koneksi, $sql); // Implement this function
                                    if ($result) {
                                        // Fetch the result
                                        $row = mysqli_fetch_assoc($result);
                                        $visits_today = $row['today_visits'];
                        
                                        // Output the count of visits today
                                        echo $visits_today." Kunjungan";
                                    }else{
                                        echo "0 Kunjungan";
                                    }
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Total Buku</h5>
                                <p class="card-text">
                                    <?php
                                // Query to get the total count of books
                                $sql_total_books = "SELECT COUNT(*) AS total_books FROM tb_buku";
                                $result_total_books = mysqli_query($koneksi, $sql_total_books);
                                $row_total_books = mysqli_fetch_assoc($result_total_books);
                                echo $row_total_books['total_books']." Buku";
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Buku Tersedia</h5>
                                <p class="card-text">
                                    <?php
                                // Query to get the count of available books
                                $sql_available_books = "SELECT SUM(jumlah_tersedia) AS total_available_books FROM tb_buku";
    $result_available_books = mysqli_query($koneksi, $sql_available_books);
    $row_available_books = mysqli_fetch_assoc($result_available_books);
    echo $row_available_books['total_available_books']." Buku Tersedia";
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
<?php
}else{
    header("Location: index.php");
    exit();
    session_destroy();
}
?>