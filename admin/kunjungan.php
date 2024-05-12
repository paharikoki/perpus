<?php

if(empty($_SESSION['user_id'])){
    echo "<script>alert('Anda harus login terlebih dahulu')</script>";
    header("Location: ./");
    die();
}else{
    if($_SESSION['user_level'] == 1){
        
            ?>
<div class="container">
    <div class="d-flex row justify-content-between align-items-center">
        <div class="col-md-6">
            <h2 class="text-start">Daftar Kunjungan</h2>
        </div>
    </div>
    <div class="mt-4">
        <form method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search..." name="keyword">
                <button class="btn btn-outline-secondary" type="submit" name="search">Search</button>
            </div>
        </form>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Waktu</th>
                    <th scope="col">Nama</th>
                    <th scope="col">NIM/NIDN</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Hp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Assuming you have established a database connection earlier and stored it in $koneksi variable
                    // Fetch data from the tb_buku table
                    $search = isset($_POST['keyword']) ? $_POST['keyword'] : '';

                    // SQL query to retrieve visit records with member details
                    $sql = "SELECT tb_kunjungan.id, tb_kunjungan.waktu, tb_anggota.nama AS nama_anggota, tb_anggota.nim, tb_anggota.email, tb_anggota.alamat, tb_anggota.nohp
                            FROM tb_kunjungan
                            INNER JOIN tb_anggota ON tb_kunjungan.id_anggota = tb_anggota.id";

                    // Add search condition if search keyword is provided
                    if (!empty($search)) {
                        $sql .= " WHERE tb_anggota.nama LIKE '%$search%' OR tb_anggota.nim LIKE '%$search%' OR tb_anggota.email LIKE '%$search%' OR tb_anggota.alamat LIKE '%$search%' OR tb_anggota.nohp LIKE '%$search%'";
                    }

                    $result = mysqli_query($koneksi, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Output table header

                        // Output data of each row
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['waktu'] . "</td>";
                            echo "<td>" . $row['nama_anggota'] . "</td>";
                            echo "<td>" . $row['nim'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['alamat'] . "</td>";
                            echo "<td>" . $row['nohp'] . "</td>";
                            echo "</tr>";
                        }

                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "No visit records found";
                    }
        ?>
            </tbody>
        </table>
    </div>
</div>
<script>
function confirmDelete(id, nama) {
    var confirmDelete = confirm("Apakah Anda yakin akan menghapus Anggota dengan Nama : '" + nama + "'?");
    if (confirmDelete) {
        window.location.href = "./index.php?hlm=anggota&aksi=hapus&id=" + id;
    }
}
</script>
<?php
    }else{
        echo "<script>alert('Anda tidak memiliki akses ke halaman ini')</script>";
        echo "<script>window.location.href = './';</script>";
    }
}