<?php include "header.php"; 
if($_SESSION['login'] == "true"){
    echo "<script type='text/javascript'>document.location.href = 'home';</script>";
}
?>
        <!-- Akhir Navbar -->

        <!-- Akhir Breadcrumb -->
        <section id="login-admin">
            <form action="" method="post" autocomplete="off" class="container">
                <div class="row text-center">
                    <img
                        src="../img/logo.png"
                        style="max-width: 300px"
                        alt="logo-admin"
                        class="mx-auto d-block"
                    />
                    <h1>RESET PASSWORD</h1>
                    <p>Masukkan email yang valid</p>
                </div>

                <div class="form-floating mb-3">
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        id="email"
                        placeholder="name@example.com"
                    />
                    <label for="email">Email address</label>
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
                    <button type="submit" name="aksiemail" class="btn btn-danger">
                        KIRIM KODE KE EMAIL
                    </button>
                </div>
                <div class="col-12 mt-3">
                    <p>
                        Sudah punya akun
                        <a href="index">Login disini >></a>
                    </p>
                </div>
            </form>
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
