<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_anggota WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $nama = $row['nama'];
    $nim = $row['nim'];
    $nohp = $row['nohp'];
    $email = $row['email'];
    $alamat = $row['alamat'];
    $password = $row['password'];
    $level_user = $row['level'];
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
                    <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap" required
                        value="<?php echo $nama?>">
                </div>
                <div class="col-md-6">
                    <label for="nim" class="form-label">NIM / NIDN</label>
                    <input type="text" class="form-control" name="nim" id="nim" placeholder="2020202020" required
                        value="<?php echo $nim?>">
                </div>
                <div class="col-md-6">
                    <label for="nohp" class="form-label">Nomor Hp</label>
                    <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Nomor hp" required
                        maxlength="15" value="<?php echo $nohp?>">
                </div>
                <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" required
                        value="<?php echo $email?>">
                </div>
                <div class="col-12">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat"
                        placeholder="Alamat"><?php echo $alamat?></textarea>
                </div>
                <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password"
                        required value="<?php echo $password?>">
                </div>
                <div class="col-12">
                    <label for="level_user" class="form-label">Level Pengguna</label>
                    <select id="level_user" class="form-select" name="level_user">
                        <option value="kosong" selected>Pilih Level Pengguna</option>
                        <option value="1" <?php echo $level_user == '1' ? 'selected' : ''; ?>>Admin</option>
                        <option value="0" <?php echo $level_user == '0' ? 'selected' : ''; ?>>Pengguna</option>
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
<?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $nim = $_POST['nim'];
        $nohp = $_POST['nohp'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $password = $_POST['password'];
        $level_user = $_POST['level_user'];   
        if ($level_user == 'kosong') {
            echo "<script>alert('Pilih level pengguna')</script>";
        } else {
            $sql = "UPDATE tb_anggota SET nama='$nama', nim='$nim', nohp='$nohp', email='$email', alamat='$alamat', password='$password', level='$level_user' WHERE id='$id'";
            if (mysqli_query($koneksi, $sql)) {
                echo "<script>location='index.php?hlm=anggota'</script>";
            } else {
                echo "<script>alert('Data gagal diubah')</script>";
                echo "<script>location='index.php?hlm=edit'</script>";
            }
        }
    }
} else {
    echo "<script>location='index.php?hlm=anggota'</script>";
}