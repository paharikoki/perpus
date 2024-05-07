<?php
session_start(); 

require_once './koneksi.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tb_anggota WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $_SESSION['user_id'] = $row['id']; 
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user_name'] = $row['nama'];
        $_SESSION['user_nim'] = $row['nim'];
        $_SESSION['user_nohp'] = $row['nohp'];
        $_SESSION['user_alamat'] = $row['alamat'];
        $_SESSION['user_level'] = $row['level'];
        if ($_SESSION['user_level'] == 1) {
            echo "<script>alert('Login berhasil')</script>";
            echo "<br/><a>Success Login. Please wait</a>";
            echo "<script>setTimeout(function(){ window.location.href = './admin/'; }, 2000);</script>";
        }else{
            echo "<script>alert('Login berhasil')</script>";
            echo "<br/><a>Success Login. Please wait</a>";
            echo "<script>setTimeout(function(){ window.location.href = './home.php'; }, 2000);</script>";
        }
    } else {
        echo "<script>alert('Login gagal')</script>";
    }
} else {
    echo "<script>alert('Login gagal')</script>";
}
?>