<?php

if (empty($_SESSION['user_id'])) {
    echo "<script>alert('Anda harus login terlebih dahulu')</script>";
    header("Location: ./");
    die();
}else{
    if ($_SESSION['user_level'] == 1) {
        if (isset($_REQUEST['aksi'])) {
            $aksi = $_REQUEST['aksi'];
            switch ($aksi) {
                case 'baru':
                    include './tambah_buku.php';
                    break;
                case 'edit':
                    include './edit_buku.php';
                    break;
                case 'hapus':
                    include './hapus_buku.php';
                    break;
                
                default:
                    include './buku.php';
                    break;
            }
        }else{
            ?>
<div class="container">
    <div class="d-flex row justify-content-between align-items-center">
        <div class="col-md-6">
            <h2 class="text-start">Daftar Buku</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="./index.php?hlm=buku&aksi=baru" class="btn btn-primary">Tambah Buku</a>
        </div>
    </div>
    <div class="mt-4">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                    <th scope="col">Jenis Buku</th>
                    <th scope="col">Jumlah Buku</th>
                    <th scope="col">Jumlah Tersedia</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
        // Assuming you have established a database connection earlier and stored it in $koneksi variable
        // Fetch data from the tb_buku table
        $sql = "SELECT * FROM tb_buku";
        $result = mysqli_query($koneksi, $sql);

        if (mysqli_num_rows($result) > 0) {
            $no = 1; // Initialize counter for row number

            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th scope='row'>" . $no . "</th>";
                echo "<td>" . $row['judul'] . "</td>";
                echo "<td>" . $row['pengarang'] . "</td>";
                echo "<td>" . $row['penerbit'] . "</td>";
                echo "<td>" . $row['tahun_terbit'] . "</td>";
                echo "<td>" . $row['genre'] . "</td>";
                echo "<td>" . $row['jumlah_total'] . "</td>";
                echo "<td>" . $row['jumlah_tersedia'] . "</td>";
                echo "<td> <a href='./index.php?hlm=buku&aksi=edit&id=" . $row['id'] . "' class='btn btn-warning'>Edit</a> <a href='#' onclick='confirmDelete(" . $row['id'] . ", \"" . $row['judul'] . "\")' class='btn btn-danger'>Hapus</a> </td>";
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
<script>
function confirmDelete(id, title) {
    var confirmDelete = confirm("Apakah Anda yakin ingin menghapus buku dengan judul: '" + title + "'?");
    if (confirmDelete) {
        window.location.href = "./index.php?hlm=buku&aksi=hapus&id=" + id;
    }
}
</script>
<?php
        }
    }else{
        echo "<script>alert('Anda tidak memiliki akses ke halaman ini')</script>";
        echo "<script>window.location.href = './';</script>";
    }
}