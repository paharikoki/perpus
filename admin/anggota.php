<?php

if(empty($_SESSION['user_id'])){
    echo "<script>alert('Anda harus login terlebih dahulu')</script>";
    header("Location: ./");
    die();
}else{
    if($_SESSION['user_level'] == 1){
        if(isset($_REQUEST['aksi'])){
            $aksi = $_REQUEST['aksi'];
            switch($aksi){
                case 'baru':
                    include './tambah_anggota.php';
                    break;
                case 'edit':
                    include './edit_anggota.php';
                    break;
                case 'hapus':
                    include 'hapus_buku.php';
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
            <h2 class="text-start">Daftar Anggota</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="./index.php?hlm=anggota&aksi=baru" class="btn btn-primary">Tambah Anggota</a>
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
                    <th scope="col">Nama</th>
                    <th scope="col">NIM/NIDN</th>
                    <th scope="col">Email</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">No Hp</th>
                    <th scope="col">Level User</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
        // Assuming you have established a database connection earlier and stored it in $koneksi variable
        // Fetch data from the tb_buku table
        if(isset($_POST['search'])){
            $keyword = $_POST['keyword']; // Get the keyword entered by the user
            $sql = "SELECT * FROM tb_anggota 
                    WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR email LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR nohp LIKE '%$keyword%'
                    ORDER BY id DESC"; // SQL query to search for records based on keyword
        } else {
            $sql = "SELECT * FROM tb_anggota ORDER BY id DESC"; // Default SQL query to fetch all records
        }
        
        $result = mysqli_query($koneksi, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $no = 1; // Initialize counter for row number
        
            // Output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<th scope='row'>" . $no . "</th>";
                echo "<td>" . $row['nama'] . "</td>";
                echo "<td>" . $row['nim'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['alamat'] . "</td>";
                echo "<td>" . $row['nohp'] . "</td>";
                echo "<td>" . ($row['level'] == 1 ? "Admin" : "User") . "</td>";
                echo "<td> <a href='./index.php?hlm=anggota&aksi=edit&id=" . $row['id'] . "' class='btn btn-warning'>Edit</a> <a href='#' onclick='confirmDelete(" . $row['id'] . ", \"" . $row['nama'] . "\")' class='btn btn-danger'>Hapus</a> </td>";
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
function confirmDelete(id, nama) {
    var confirmDelete = confirm("Apakah Anda yakin akan menghapus Anggota dengan Nama : '" + nama + "'?");
    if (confirmDelete) {
        window.location.href = "./index.php?hlm=anggota&aksi=hapus&id=" + id;
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