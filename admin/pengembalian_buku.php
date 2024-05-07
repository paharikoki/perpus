<?php

if (empty($_SESSION['user_id']) ) {
    echo "<script>alert('Anda harus login terlebih dahulu')</script>";
    header("Location: ./");
    die();
}else{
    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tb_pinjam WHERE id='$id'";
        $result = mysqli_query($koneksi, $sql);
        if (mysqli_num_rows($result) > 0) {

        $data = mysqli_fetch_assoc($result);
        $sqlBuku = "SELECT * FROM tb_buku WHERE isbn='" . $data['isbn'] . "'";
        $resultBuku = mysqli_query($koneksi, $sqlBuku);
        $dataBuku = mysqli_fetch_assoc($resultBuku);
        $tanggal_pinjam = date_create($data['tanggal_pinjam']);
        $tanggal_kembali = date_create($data['tanggal_kembali']);
        $tanggal_sekarang = date_create(date('Y-m-d'));
        $selisih = date_diff($tanggal_kembali, $tanggal_sekarang);
        $denda = 0;
        if ($selisih->format('%R%a') > 0) {
            $denda = $selisih->format('%a') * 1000;
        }
        ?>
<div class="container d-flex justify-content-center align-items-center">

    <div class="card p-3 col-md-8">
        <div class="col-md-6">
            <h2 class="text-start">Pengembalian Buku</h2>
        </div>
        <div class="mt-4">
            <form method="POST" class="row px-2">
                <div class="mb-3 col-6">
                    <label for="id_pinjam" class="form-label">ID Pinjam</label>
                    <input type="text" class="form-control" id="id_pinjam" name="id_pinjam"
                        value="<?php echo $data['id']; ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="isbn" class="form-label">Nomor ISBN Buku</label>
                    <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $data['isbn']; ?>"
                        readonly>
                </div>
                <div class="mb-3 col-12">
                    <label for="judul" class="form-label">Judul Buku</label>
                    <input type="text" class="form-control" id="judul" name="judul"
                        value="<?php echo $dataBuku['judul']; ?>" readonly>
                </div>
                <div class="mb-3 col-12">
                    <label for="jumlah_pinjam" class="form-label">Jumlah Buku Dipinjam</label>
                    <input type="text" class="form-control" id="jumlah_pinjam" name="jumlah_pinjam"
                        value="<?php echo $data['jumlah_pinjam']; ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="id_anggota" class="form-label">ID Anggota</label>
                    <input type="text" class="form-control" id="id_anggota" name="id_anggota"
                        value="<?php echo $data['id_anggota']; ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="nama_anggota" class="form-label">Nama Anggota</label>
                    <?php
                $sqlAnggota = "SELECT * FROM tb_anggota WHERE id='" . $data['id_anggota'] . "'";
                $resultAnggota = mysqli_query($koneksi, $sqlAnggota);
                $dataAnggota = mysqli_fetch_assoc($resultAnggota);
                ?>
                    <input type="text" class="form-control" id="nama_anggota" name="nama_anggota"
                        value="<?php echo $dataAnggota['nama']; ?>" readonly>

                </div>
                <div class="mb-3 col-6">
                    <label for="id_petugas" class="form-label">ID Petugas</label>
                    <input type="text" class="form-control" id="id_petugas" name="id_petugas"
                        value="<?php echo $data['id_petugas']; ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="nama_petugas" class="form-label">Nama Petugas</label>
                    <?php
                $sqlAnggota = "SELECT * FROM tb_anggota WHERE id='" . $data['id_petugas'] . "'";
                $resultAnggota = mysqli_query($koneksi, $sqlAnggota);
                $dataAnggota = mysqli_fetch_assoc($resultAnggota);
                ?>
                    <input type="text" class="form-control" id="nama_anggota" name="nama_anggota"
                        value="<?php echo $dataAnggota['nama']; ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="text" class="form-control" id="tanggal_pinjam" name="tanggal_pinjam"
                        value="<?php echo date_format($tanggal_pinjam, 'd-m-Y'); ?>" readonly>
                </div>
                <div class="mb-3 col-6">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="text" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                        value="<?php echo date_format($tanggal_kembali, 'd-m-Y'); ?>" readonly>
                </div>
                <div class="mb-3 col-12">
                    <label for="tanggal_sekarang" class="form-label">Tanggal Sekarang</label>
                    <input type="text" class="form-control" id="tanggal_sekarang" name="tanggal_sekarang"
                        value="<?php echo date_format($tanggal_sekarang, 'd-m-Y'); ?>" readonly>
                </div>
                <div class="mb-3 col-12">
                    <label for="denda" class="form-label">Denda</label>
                    <input type="text" class="form-control" id="denda" name="denda" value="<?php echo $denda; ?>"
                        readonly>
                </div>
                <div class="mb-3 col-12 d-flex row gap-3">
                    <button type="submit" class="btn btn-primary w-100" name="submit">Kembalikan</button>
                    <a href="./index.php?hlm=pinjam" class="btn btn-outline-secondary w-100">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
            if (isset($_POST['submit'])) {
                $id_pinjam = $_POST['id_pinjam'];
                $denda = $_POST['denda'];
                $sql = "UPDATE tb_pinjam SET tanggal_kembali='" . date('Y-m-d') . "', denda='$denda',returned='1' WHERE id='$id_pinjam'";
                $result = mysqli_query($koneksi, $sql);
                if ($result) {
                    $sql = "SELECT * FROM tb_buku WHERE isbn='" . $data['isbn'] . "'";
                    $result = mysqli_query($koneksi, $sql);
                    $dataBuku = mysqli_fetch_assoc($result);
                    $jumlah_tersedia = $dataBuku['jumlah_tersedia'] + $data['jumlah_pinjam'];
                    $sql = "UPDATE tb_buku SET jumlah_tersedia='$jumlah_tersedia' WHERE isbn='" . $data['isbn'] . "'";
                    $result = mysqli_query($koneksi, $sql);
                    if ($result) {
                        echo "<script>alert('Buku berhasil dikembalikan')</script>";
                        echo "<script>window.location.href = './index.php?hlm=pinjam';</script>";
                    } else {
                        echo "<script>alert('Terjadi kesalahan')</script>";
                        echo "<script>window.location.href = './index.php?hlm=pinjam';</script>";
                    }
                } else {
                    echo "<script>alert('Terjadi kesalahan')</script>";
                    echo "<script>window.location.href = './index.php?hlm=pinjam';</script>";
                }
            }
        }else{
            echo "<script>alert('Data tidak ditemukan');window.location='./index.php?hlm=pinjam'</script>";
        }
    }else{
        echo "<script>alert('Data tidak ditemukan');window.location='./index.php?hlm=pinjam'</script>";
    }
}