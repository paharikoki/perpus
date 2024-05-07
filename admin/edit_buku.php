<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_buku WHERE id = '$id'";
    $result = mysqli_query($koneksi, $sql);
    $row = mysqli_fetch_assoc($result);
    $isbn_buku = $row['isbn'];
    $judul_buku = $row['judul'];
    $pengarang_buku = $row['pengarang'];
    $penerbit_buku = $row['penerbit'];
    $tahun_terbit = $row['tahun_terbit'];
    $total_buku = $row['jumlah_total'];
    $jenis_buku = $row['genre'];
    $jumlah_tersedia = $row['jumlah_tersedia'];
    ?>
<div class="container">

    <div class="row">
        <h2 class="text-center">Edit Buku</h2>
    </div>
    <div class="d-flex col gap-3 mt-2 justify-content-center align-items-center">
        <div class="card p-3 col-md-6">
            <form class="row g-3" action="./index.php?hlm=buku&aksi=edit&id=<?php echo $id; ?>" method="post">
                <div class="col-md-12">
                    <label for="isbn_buku" class="form-label">ISBN Buku</label>
                    <input type="text" name="isbn_buku" class="form-control" id="isbn_buku" maxlength="11"
                        value="<?php echo $isbn_buku; ?>">
                </div>
                <div class="col-md-12">
                    <label for="judul_buku" class="form-label">Judul</label>
                    <input type="text" class="form-control" name="judul_buku" id="judul_buku"
                        value="<?php echo $judul_buku; ?>">
                </div>
                <div class="col-md-12">
                    <label for="pengarang_buku" class="form-label">Pengarang Buku</label>
                    <input type="text" class="form-control" name="pengarang_buku" id="pengarang_buku"
                        value="<?php echo $pengarang_buku; ?>">
                </div>
                <div class="col-md-12">
                    <label for="penerbit_buku" class="form-label">Penerbit Buku</label>
                    <input type="text" class="form-control" name="penerbit_buku" id="penerbit_buku"
                        value="<?php echo $penerbit_buku; ?>">
                </div>
                <div class="col-md-12">
                    <label for="tahun_terbit" class="form-label">Tahun Penerbit Buku</label>
                    <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                        max="<?php echo date('Y'); ?>" value="<?php echo date('Y'); ?>"
                        value="<?php echo $tahun_terbit; ?>">
                </div>
                <div class="col-md-12">
                    <label for="total_buku" class="form-label">Jumlah Buku</label>
                    <input type="number" class="form-control" min="1" name="total_buku" id="total_buku"
                        value="<?php echo $total_buku; ?>">
                </div>
                <div class="col-md-12">
                    <label for="inputState" class="form-label">Jenis Buku</label>
                    <select id="inputState" class="form-select" name="jenis_buku">
                        <option value="kosong" selected>Pilih Jenis Buku</option>
                        <option value="pelajaran" <?php echo $jenis_buku == 'pelajaran' ? 'selected' : ''; ?>>Pelajaran
                        </option>
                        <option value="fiksi" <?php echo $jenis_buku == 'fiksi' ? 'selected' : ''; ?>>Fiksi</option>
                        <option value="romantis" <?php echo $jenis_buku == 'romantis' ? 'selected' : ''; ?>>Romantis
                        </option>
                    </select>
                </div>
                <div class="col-md-12 mt-4">
                    <button type="submit" name="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const isbn = document.getElementById('isbn_buku');
isbn.addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});
</script>
<?php
    if (isset($_REQUEST['submit'])) {
        $isbn_buku = $_POST['isbn_buku'];
        $judul_buku = $_POST['judul_buku'];
        $pengarang_buku = $_POST['pengarang_buku'];
        $penerbit_buku = $_POST['penerbit_buku'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $total_buku = $_POST['total_buku'];
        $jenis_buku = $_POST['jenis_buku'];
        if ($jenis_buku == 'kosong') {
            echo "<script>alert('Silakan pilih jenis buku')</script>";
        } else {
            if (!empty($_SESSION['user_id']) && $_SESSION['user_level'] == 1) {
                var_dump($isbn_buku, $judul_buku, $pengarang_buku, $penerbit_buku, $tahun_terbit, $total_buku, $jenis_buku, $id);
                $sql_check = "SELECT COUNT(*) AS count FROM tb_buku WHERE isbn = '$isbn_buku' AND id != '$id'";
                $result_check = mysqli_query($koneksi, $sql_check);
                $row = mysqli_fetch_assoc($result_check);
                $isbn_count = $row['count'];

                if ($isbn_count > 0) {
                    // ISBN already exists for other books
                    echo "<script>alert('ISBN sudah ada dalam database')</script>";
                    echo "<script>window.location.href = './index.php?hlm=buku';</script>";
                } else {
                    $sql = "UPDATE tb_buku SET isbn = '$isbn_buku', judul = '$judul_buku', pengarang = '$pengarang_buku', penerbit = '$penerbit_buku', tahun_terbit = '$tahun_terbit', jumlah_total = '$total_buku', genre = '$jenis_buku', jumlah_tersedia = '$total_buku' WHERE id = '$id'";
                    $result = mysqli_query($koneksi, $sql);

                    if ($result) {
                        echo "<script>alert('Berhasil Mengubah buku')</script>";
                        echo "<script>window.location.href = './index.php?hlm=buku';</script>";
                    } else {
                        echo "<script>alert('Gagal Mengubah buku')</script>";
                        echo "<script>window.location.href = './index.php?hlm=buku';</script>";
                    }
                }
            } else {
                echo "<script>alert('Anda tidak memiliki akses ke halaman ini')</script>";
                echo "<script>window.location.href = './';</script>";
            }
        }
    }
}