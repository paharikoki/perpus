<?php

if (empty($_SESSION['user_id']) ) {
    echo "<script>alert('Anda harus login terlebih dahulu')</script>";
    header("Location: ./");
    die();
}else{
    if ($_SESSION['user_level'] == 1) {
        if (isset($_REQUEST['aksi'])) {
            $aksi = $_REQUEST['aksi'];
            switch ($aksi) {
                case 'pinjam':
                    include './pinjam_buku.php';
                    break;
                case 'kembali':
                    include './pengembalian_buku.php';
                    break;
                default:
                    include './pinjam.php';
                    break;
            }
        }else{
    ?>
<div class="container">
    <div class="d-flex col gap-3 mt-2">
        <div class="col-md-6 w-100">
            <h2 class="text-start">Daftar Peminjaman Buku</h2>
            <div class="mt-4">
                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..." name="keyword">
                        <button class="btn btn-outline-secondary" type="submit">Search</button>
                    </div>
                </form>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Id Pinjam</th>
                            <th scope="col">Nama Peminjam</th>
                            <th scope="col">Nama Petugas</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Jumlah Buku</th>
                            <th scope="col">Telah Pengembalian</th>
                            <th scope="col">Terlambat Pengembalian</th>
                            <th scope="col">Denda</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
        $search = isset($_POST['search']) ? $_POST['search'] : '';
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';
        
        $sql = "SELECT tb_pinjam.*, tb_anggota.nama AS nama_peminjam, tb_anggota_petugas.nama AS nama_petugas
                FROM tb_pinjam
                INNER JOIN tb_anggota ON tb_pinjam.id_anggota = tb_anggota.id
                INNER JOIN tb_anggota AS tb_anggota_petugas ON tb_pinjam.id_petugas = tb_anggota_petugas.id";
        if (!empty($keyword)) {
            // Modify the SQL query to filter results based on search query
            $sql .= " WHERE tb_anggota.nama LIKE '%$keyword%' OR tb_anggota_petugas.nama LIKE '%$keyword%' OR tb_pinjam.tanggal_pinjam LIKE '%$keyword%' OR tb_pinjam.tanggal_kembali LIKE '%$keyword%'";
        }
        
        $result = mysqli_query($koneksi, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $no = 1; // Initialize counter for row number
        
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th scope='row'>" . $no . "</th>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nama_peminjam'] . "</td>";
                echo "<td>" . $row['nama_petugas'] . "</td>";
                // Outputting other table data as before
                echo "<td>" . $row['tanggal_pinjam'] . "</td>";
                echo "<td>" . $row['tanggal_kembali'] . "</td>";
                echo "<td>" . $row['jumlah_pinjam'] . "</td>";
                echo "<td>" . ($row['returned'] == 1 ? 'Telah Dikembalikan' : 'Belum Dikembalikan') . "</td>";
                if ($row['returned'] == 1) {
                    echo "<td>0 Hari</td>";
                } else {
                    $currentDate = new DateTime();
                    $interval = $currentDate->diff(new DateTime($row['tanggal_kembali']));
                    $numberOfDays = $interval->days;
                    echo "<td>" . $numberOfDays . " Hari</td>";
                }
                $denda = $row['denda'];
                if ($row['returned'] == 0) {
                    $tanggal_sekarang = date('Y-m-d');
                    $tanggal_kembali = $row['tanggal_kembali'];
                    $selisih = strtotime($tanggal_sekarang) - strtotime($tanggal_kembali);
                    if ($selisih > 0) {
                        $jumlah_hari_terlambat = floor($selisih / (60 * 60 * 24));
                        $denda = $jumlah_hari_terlambat * 1000;
                    }
                }
                echo "<td>Rp." . $denda . "</td>";
                echo "<td><a href='./index.php?hlm=pinjam&aksi=kembali&id=" . $row['id'] . "' class='btn btn-primary'>Dikembalikan</a></td>";
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
</div>

<?php
    }
}else{
    echo "<script>alert('Anda tidak memiliki akses ke halaman ini')</script>";
    echo "<script>window.location.href = './';</script>";
}
}