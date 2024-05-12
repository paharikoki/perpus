<?php

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $nohp = $_POST['nohp'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $instansi = $_POST['instansi'];
    $password = $_POST['password'];
    $level_user = $_POST['level_user'];

    $query = "INSERT INTO tb_anggota (nama, nim, nohp, email, alamat, password,level,instansi) VALUES ('$nama', '$nim', '$nohp', '$email', '$alamat', '$password', '$level_user','$instansi')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil ditambahkan')</script>";
        echo "<script>location='index.php?page=anggota'</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan')</script>";
        echo "<script>location='index.php?page=tambah_anggota'</script>";
    }
}
?>
<div class="container">

    <div class="d-flex col gap-3 mt-2 justify-content-center align-items-center">
        <div class="card p-3 col-md-6">

            <div class="row">
                <h2 class="text-center">Tambah Anggota</h2>
            </div>
            <hr>
            <form class="row g-3" method="post">
                <div class="col-12">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required>
                </div>
                <div class="col-md-6">
                    <label for="nim" class="form-label">NIM / NIDN</label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="2020202020" required>
                </div>
                <div class="col-md-6">
                    <label for="nohp" class="form-label">Nomor Hp</label>
                    <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Nomor hp" required
                        maxlength="15">
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="col-md-6">
                    <label for="instansi" class="form-label">Instansi</label>
                    <input type="text" class="form-control" name="instansi" id="instansi" placeholder="Universitas"
                        required>
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat" required></textarea>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required>
                </div>
                <div class="col-12">
                    <label for="level_user" class="form-label">Level Pengguna</label>
                    <select id="level_user" class="form-select" name="level_user">
                        <option value="kosong" selected>Pilih Level Pengguna</option>
                        <option value="1">Admin</option>
                        <option value="0">Pengguna</option>
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-grid gap-2">
                        <input type="submit" name="submit" class="btn btn-primary btn-block"></input>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>