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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <?php 
        include 'menu.php';
    ?>
    <main class="d-flex justify-content-center align-items-center mt-4">
        <div class="container">
            <?php
            if( isset($_REQUEST['hlm'])){
                $hlm = $_REQUEST['hlm'];
                switch ($hlm) {
                    case 'pinjam_buku':
                        include 'pinjam_buku.php';
                        break;
                    
                    default:
                        break;
                }
            }else{
            ?>
            <div class="card text-center p-5">
                <h2 class=" fs-2">APLIKASI Perpustakaan Digital</h2>
                <p class="lead">Universitas Negeri Malang</p>
                <p>Selamat Datang <strong><?php echo $_SESSION['user_name']; ?></strong></p>
            </div>
            <?php
            }?>
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