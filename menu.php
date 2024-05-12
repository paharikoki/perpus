<?php
if( !empty( $_SESSION['user_id'] ) ){
?>
<!-- Fixed navbar -->
<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="./home.php">Taman Pustaka</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./home.php">Home</a>
                </li>
            </ul>
            <form class="d-flex" role="search" action="./logout.php">
                <button class="btn btn-outline-warning" type="submit">Log Out</button>
            </form>
        </div>
    </div>
</nav>
<?php
} else {
	header("Location: ./");
	die();
}
?>