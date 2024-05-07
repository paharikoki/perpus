<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
    .bg-image {
        background-image: url('images/bglogin.jpg');
        background-size: cover;
        height: 100vh;
    }

    .login-form {
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
    }
    </style>
</head>

<body>
    <div class="container-fluid bg-image">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-md-3">
                <div class="login-form p-4">
                    <h2 class="text-center mb-4">Register</h2>
                    <form class="row g-3" action="./action_register.php" method="post">
                        <div class="col-12">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Lengkap"
                                required>
                        </div>
                        <div class="col-md-6">
                            <label for="nim" class="form-label">Nomor Induk Mahasiswa</label>
                            <input type="text" class="form-control" name="nim" id="nim"
                                placeholder="Nomor Induk Mahasiswa" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nohp" class="form-label">Nomor Hp</label>
                            <input type="text" class="form-control" name="nohp" id="nohp" placeholder="Nomor hp"
                                required>
                        </div>
                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                                required>
                        </div>
                        <div class="col-12">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" placeholder="Alamat"
                                required></textarea>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                placeholder="Password" required>
                        </div>

                        <div class="col-12 ">
                            <div class="d-grid gap-2">
                                <input type="submit" name="submit" class="btn btn-primary btn-block"></input>
                                <a class="btn btn-outline-primary" href="./index.php" role="button">Masuk</a>
                            </div>
                        </div>
                    </form>
                    <!-- <form>
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="nim" class="form-label">Nomor Induk Mahasiswa</label>
                            <input type="text" class="form-control" id="nim" placeholder="Nomor Induk Mahasiswa"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="nohp" class="form-label">Nomor Hp</label>
                            <input type="text" class="form-control" id="nohp" placeholder="Nomor hp" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" placeholder="Alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">

                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                            <a class="btn btn-outline-primary" href="./index.php" role="button">Masuk</a>
                        </div>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>