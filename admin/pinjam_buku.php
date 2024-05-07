<?php
if (empty($_SESSION['user_id']) ) {
    echo "<script>alert('Anda harus login terlebih dahulu')</script>";
    header("Location: ./");
    die();
}else{
    if (isset($_POST['submit'])) {
        $isbn = $_POST['isbn'];
        $id_anggota = $_POST['id_anggota'];
        $id_petugas = $_POST['id_petugas'];
        $tanggal_pinjam = date('Y-m-d');
        $tanggal_kembali = $_POST['tanggal_kembali'];
        $jumlah_pinjam = $_POST['jumlah_pinjam'];
        $sql = "SELECT * FROM tb_buku WHERE isbn='$isbn'";
        $result = mysqli_query($koneksi, $sql);
        $data = mysqli_fetch_assoc($result);
        $jumlah_tersedia = $data['jumlah_tersedia'];
        if ($jumlah_tersedia < $jumlah_pinjam) {
            echo "<script>alert('Jumlah buku yang dipinjam melebihi jumlah buku yang tersedia')</script>";
        } else {
            $currentDate = date('dmy');
            $sql = "SELECT MAX(id) AS max_id FROM tb_pinjam";
            $result = mysqli_query($koneksi, $sql);
            $row = mysqli_fetch_assoc($result);
            $lastId = $row['max_id'];
            $sequentialNumber = intval(substr($lastId, -4)) + 1;
            $paddedSequentialNumber = str_pad($sequentialNumber, 4, '0', STR_PAD_LEFT);
            $newId = $currentDate . $paddedSequentialNumber;
            
            $sql = "INSERT INTO tb_pinjam (id,isbn, id_anggota, id_petugas, tanggal_pinjam, tanggal_kembali, jumlah_pinjam) VALUES ('$newId','$isbn', '$id_anggota', '$id_petugas', '$tanggal_pinjam', '$tanggal_kembali', '$jumlah_pinjam')";
            $result = mysqli_query($koneksi, $sql);
            if ($result) {
                $jumlah_tersedia = $jumlah_tersedia - $jumlah_pinjam;
                $sql = "UPDATE tb_buku SET jumlah_tersedia='$jumlah_tersedia' WHERE isbn='$isbn'";
                $result = mysqli_query($koneksi, $sql);
                if ($result) {
                    echo "<script>alert('Berhasil meminjam buku')</script>";
                    echo "<script>window.location.href = './index.php?hlm=pinjam-buku';</script>";
                } else {
                    echo "<script>alert('Gagal meminjam buku')</script>";
                }
            } else {
                echo "<script>alert('Gagal meminjam buku')</script>";
            }
        }
    }
?>
<div class="container">
    <div class="d-flex col gap-3 mt-2 justify-content-center align-items-center">
        <div class="card p-3 col-md-6">
            <div class="col-md-6">
                <h2 class="text-start">Pinjam Buku</h2>
            </div>
            <div class="mt-4">
                <form method="POST">
                    <div class="mb-3">
                        <label for="isbn" class="form-label">Nomor ISBN Buku</label>
                        <input type="text" class="form-control" id="isbn" name="isbn" required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="./index.php?hlm=pinjam-buku" class="btn btn-secondary">Reset</a>
                        <button type="submit" class="btn btn-primary" name="cari_buku">Cari Buku</button>
                    </div>
                </form>
                <form method="post">
                    <?php
                    if (isset($_POST['cari_buku'])) {
                        $isbn = $_POST['isbn'];
                        $sql = "SELECT * FROM tb_buku WHERE isbn='$isbn'";
                        $result = mysqli_query($koneksi, $sql);
                        $data = mysqli_fetch_assoc($result);
                        if (mysqli_num_rows($result) > 0) {
                            echo "<div class=\"mt-3\">";
                            echo "<h5 class=\"text-center\">Detail Buku</h5>";
                            echo "<table class=\"table table-bordered\">";
                            echo "<tr><td>ISBN Buku</td><td>$data[isbn]</td></tr>";
                            echo "<tr><td>Judul Buku</td><td>$data[judul]</td></tr>";
                            echo "<tr><td>Pengarang</td><td>$data[pengarang]</td></tr>";
                            echo "<tr><td>Penerbit</td><td>$data[penerbit]</td></tr>";
                            echo "<tr><td>Tahun Terbit</td><td>$data[tahun_terbit]</td></tr>";
                            echo "<tr><td>Jumlah Tersedia</td><td>$data[jumlah_tersedia]</td></tr>";
                            echo "</table>";
                            echo "</div>";
                            echo "<input type=\"hidden\" name=\"isbn\" value=\"$data[isbn]\">";
                            ?>
                    <input type="hidden" name="id_petugas" value="<?php echo $_SESSION['user_id']?>">
                    <div class="mb-3">
                        <label for="id_anggota" class="form-label">Pilih Nama Peminjaman</label>
                        <select id="id_anggota" class="form-select" name="id_anggota">
                            <option value="kosong" selected>Pilih Nama Peminjaman</option>
                            <?php
                                $sql = "SELECT * FROM tb_anggota WHERE level='0' ORDER BY nama ASC";
                                $result = mysqli_query($koneksi, $sql);
                                while ($data = mysqli_fetch_assoc($result)) {
                                    echo "<option value=\"$data[id]\">$data[nama]</option>";
                                }
                                ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian</label>
                        <input type="date" class="form-control" id="tanggal_kembali" name="tanggal_kembali"
                            min="<?php echo date('Y-m-d'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_pinjam" class="form-label">Jumlah Buku yang Dipinjam</label>
                        <input type="number" class="form-control" id="jumlah_pinjam" name="jumlah_pinjam" min="1"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100" name="submit">Pinjam Buku</button>
                    <?php
                        } else {
                            echo "<div class=\"alert alert-danger mt-3\">Buku dengan ISBN $isbn tidak ditemukan</div>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
}