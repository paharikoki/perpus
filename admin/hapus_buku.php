<?php

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Access the 'id' parameter using $_GET instead of $_REQUEST
    $checkSql = "SELECT * FROM tb_buku WHERE id='$id'";
    $checkResult = mysqli_query($koneksi, $checkSql);
    if (mysqli_num_rows($checkResult) > 0) {
        $deleteSql = "DELETE FROM tb_buku WHERE id='$id'";
        $deleteResult = mysqli_query($koneksi, $deleteSql);
        if ($deleteResult) {
            echo "<script>alert('Data berhasil dihapus')</script>";
            echo "<meta http-equiv='refresh' content='0;url=./index.php?hlm=buku'>";
        } else {
            echo "<script>alert('Data gagal dihapus')</script>";
            echo "<meta http-equiv='refresh' content='0;url=./index.php?hlm=buku'>";
        }
    } else {
        echo "<script>alert('Buku tidak ditemukan')</script>";
        echo "<meta http-equiv='refresh' content='0;url=./index.php?hlm=buku'>";
    }
}