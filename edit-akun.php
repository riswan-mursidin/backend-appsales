<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
?>
    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                Edit Akun
                </li>
            </ol>
        </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="login-admin">
        <div class="container">
            <div class="row text-center">
            <img
                src="img-admin/logo-icon-dark.svg"
                style="max-width: 150px"
                alt="logo-admin"
                class="mx-auto d-block"
            />
            <h1 class="mt-5 mb-5">EDIT AKUN</h1>
            </div>
            <form action="" method="post" autocomplete="off">
            <div class="form-floating mb-3">
                <input
                disabled
                type="text"
                name="username"
                class="form-control"
                id="floatingInput"
                value="<?= $rowakun['username'] ?>"
                placeholder="name@example.com"
                />
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input
                type="email"
                name="email"
                value="<?= $rowakun['email'] ?>"
                class="form-control"
                id="floatingInput"
                placeholder="name@example.com"
                />
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating mb-3">
                <input
                type="password"
                name="password"
                class="form-control"
                id="floatingPassword"
                placeholder="Password"
                />
                <label for="floatingPassword">Password</label>
                <?php if($notif_error != ""){ ?>
                <p class="notif-eror" style="font-size: 10px; color:red;">
                *<?php echo $notif_error; ?>
                </p>
                <?php } ?>
            </div>
    
            <div
                class="col-12 btn-group"
                role="group"
                aria-label="Basic mixed styles example"
            >
                <button type="submit" name="editakun" class="btn btn-danger">SIMPAN</button>
            </div>
            </form>
        </div>
        <p class="mt-5 footer text-center">
            support by
            <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
    ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    </body>
</html>
<?php mysqli_close($conn) ?>
