<?php
 require_once './koneksi.php';

 if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $nohp = $_POST['nohp'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $password = $_POST['password'];
        $level = 0;
    
        $sql = "INSERT INTO tb_anggota (nama, nim, nohp, email, alamat, password,level) VALUES ('$nama', '$nim', '$nohp', '$email', '$alamat', '$password','$level')";
        if (mysqli_query($koneksi, $sql)) {
            echo "<script>alert('Data berhasil ditambahkan')</script>";
            echo "<br/><a href='javascript:self.history.back();'>Go Back. Please wait</a>";
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Data gagal ditambahkan atas')</script>";
        }
 }else{
        echo "<script>alert('Data gagal ditambahkan')</script>";
 }
?>