<?php
session_start();
require_once './koneksi.php';
if (isset($_SESSION['user_id']) && $_SESSION['user_email'] ) {
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <style>
    .h-home {
        height: 40vh;
    }

    .bg-home {
        background-image: url('./images/bglogin.jpg');
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
    <main class="d-flex  justify-content-center align-items-center ">
        <div class="col">
            <div class="w-100 bg-warning h-home bg-home position-relative">
                <div class="overlay"></div>
                <div class="text-center p-5 position-relative text-white">
                    <div class="content">
                        <h2 class="fs-2">Sistem Perpustakaan Taman Pustaka</h2>
                        <p class="lead">Universitas Negeri Malang</p>
                    </div>
                </div>
            </div>

            <div class="container">
                ?>
                <div class=" text-center p-5 position-relative h-home">
                    <div class="content">
                        <h2 class="fs-2">Selamat Datang <?php echo $_SESSION['user_name']; ?> <br>Di Perpustakaan
                            Taman Pustaka <br> Universitas Negeri Malang</h2>
                        <?php
                        $id = $_SESSION['user_id'];
                        $sql = "SELECT * FROM tb_kunjungan WHERE id_anggota = '$id' ORDER BY waktu DESC LIMIT 1";
                        $result = mysqli_query($koneksi, $sql);
                        $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            $waktu = date('d F Y H:i:s', strtotime($row['waktu']));
                            echo "<p>Waktu terakhir anda berkunjung pada $waktu</p>";
                        }
                        ?>
                        <table class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal kunjungan</th>
                                    <th scope="col">Waktu kunjungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
        // Assuming you have established a database connection earlier and stored it in $koneksi variable
        // Fetch data from the tb_buku table
        $sql = "SELECT * FROM tb_kunjungan where id_anggota = '$id' ";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            $no = 1; // Initialize counter for row number

            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th scope='row'>" . $no . "</th>";
                $waktu = date('d F Y', strtotime($row['waktu']));
                $jam = date('H:i:s', strtotime($row['waktu']));
                echo "<td>" . $waktu . "</td>";
                echo "<td>" . $jam . "</td>";
                echo "</tr>";

                $no++; // Increment row number
            }
        } else {
            echo "<tr><td colspan='9' class='text-center'>No records found</td></tr>";
        }
        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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