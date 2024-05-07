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
            <h2 class="text-start">Pengembalian Buku</h2>
            <div class="mt-4">
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
                            <th scope="col">Denda</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
        // Assuming you have established a database connection earlier and stored it in $koneksi variable
        // Fetch data from the tb_buku table
        $sql = "SELECT * FROM tb_pinjam";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            $no = 1; // Initialize counter for row number

            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th scope='row'>" . $no . "</th>";
                echo "<td>" . $row['id'] . "</td>";
                $sql = "SELECT * FROM tb_anggota WHERE id='" . $row['id_anggota'] . "'";
                $resultAnggota = mysqli_query($koneksi, $sql);
                $rowAnggota = mysqli_fetch_assoc($resultAnggota);
                echo "<td>" . $rowAnggota['nama'] . "</td>";
                $sql = "SELECT * FROM tb_anggota WHERE id='" . $row['id_petugas'] . "'";
                $resultPetugas = mysqli_query($koneksi, $sql);
                $rowPetugas = mysqli_fetch_assoc($resultPetugas);
                echo "<td>" . $rowPetugas['nama'] . "</td>";
                echo "<td>" . $row['tanggal_pinjam'] . "</td>";
                echo "<td>" . $row['tanggal_kembali'] . "</td>";
                echo "<td>" . $row['jumlah_pinjam'] . "</td>";
                $currentDate = new DateTime();
                $interval = $currentDate->diff(new DateTime($row['tanggal_kembali']));
                $numberOfDays = $interval->days;
                echo "<td>" . $numberOfDays . "</td>";
                $denda = 0;
                $tanggal_sekarang = date('Y-m-d');
                $tanggal_kembali = $row['tanggal_kembali'];
                $selisih = strtotime($tanggal_sekarang) - strtotime($tanggal_kembali);
                if ($selisih > 0) {
                    $jumlah_hari_terlambat = floor($selisih / (60 * 60 * 24));
                    $denda = $jumlah_hari_terlambat * 1000;
                }
                echo "<td>Rp." . $denda . "</td>";
                echo "<td><a href='./index.php?hlm=pinjam&aksi=kembali&id=" . $row['id'] . "' class='btn btn-primary'>Kembalikan</a></td>";
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