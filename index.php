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
                    <h2 class="text-center mb-4">Login</h2>
                    <form action="./action_login.php" method="post">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                        </div>
                        <div class="mb-3">

                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password" required>
                        </div>
                        <div class="d-grid gap-2">
                            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Masuk"></input>
                            <a class="btn btn-outline-primary" href="./register.php" role="button">Daftar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>