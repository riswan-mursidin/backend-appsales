<?php include "header.php";
if($_SESSION['login'] == TRUE){
  echo "<script type='text/javascript'>document.location.href = 'home';</script>";
}
?>
    <!-- Akhir Navbar -->
    
    <section id="login-admin">
      <div class="container">
        <div class="row text-center">
          <img
            src="img-admin/logo-icon-dark.svg"
            style="max-width: 150px"
            alt="logo-admin"
            class="mx-auto d-block"
          />
          <h1 class="mt-5 mb-5">LOGIN AKUN</h1>
          <p>
            Selamat datang di aplikasi sales, <br />
            Masukkan username dan password anda
          </p>
        </div>
        <form action="" method="post" autocomplete="off">
          <div class="form-floating mb-3">
            <input
              type="text"
              name="emailusername"
              class="form-control"
              id="floatingInput"
              placeholder="name@example.com"
            />
            <label for="floatingInput">Email address / Username</label>
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
          <div class="col-12">
            <p>Lupa password <a href="reset-password">Klik disini >></a></p>
          </div>
  
          <div
            class="col-12 btn-group"
            role="group"
            aria-label="Basic mixed styles example"
          >
            <button type="submit" name="login" class="btn btn-danger">MASUK</button>
          </div>
        </form>

        <div class="col-12 mt-3">
          <p>
            Belum punya akun
            <a href="registrasi">Daftar disini >></a>
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
<?php mysqli_close($conn) ?>