<?php include "header.php"; 

if($_SESSION['email'] == "" ){
    echo "<script type='text/javascript'>document.location.href = 'reset-password';</script>";
}
?>
    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#admin">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="login-admin">
      <div class="container">
        <div class="row text-center">
          <img
            src="../img/logo.png"
            style="max-width: 300px"
            alt="logo-admin"
            class="mx-auto d-block"
          />
          <h1>INPUT KODE VALIDATION</h1>
          <p>
            Kami telah mengirimkan kode validation ke email anda. <br />
            Periksa email kotak masuk atau difolder spam
          </p>
        </div>
        <form action="" method="post" autocomplete="off">
            <div class="form-floating mb-3">
              <input
                type="number"
                name="kode"
                class="form-control"
                id="floatingInput"
                placeholder="name@example.com"
              />
              <label for="floatingInput">Masukkan kode</label>
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
              <button type="submit" name="aksikode" class="btn btn-danger">KIRIM KODE BARU</button>
            </div>
        </form>
        <div class="col-12 mt-3">
          <p>
            Sudah punya akun
            <a href="login.html">Login disini >></a>
          </p>
        </div>
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
