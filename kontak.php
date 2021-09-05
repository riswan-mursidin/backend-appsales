<?php include "header.php";
if($_SESSION['login'] != TRUE){
  echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
// profil
$queryprofil = mysqli_query($conn, "SELECT * FROM profil_admin WHERE id_admin='$_SESSION[user]'");
$rowprofile = mysqli_fetch_assoc($queryprofil);

// galeri
$querygaleri = mysqli_query($conn, "SELECT * FROM galeri_sales WHERE id_admin='$_SESSION[user]' LIMIT 10");
?>
<!-- Kontak -->
    <div class="container kontak">
      <div class="row">
        <div class="col-12 text-center">
          <img
            src="../<?= $rowprofile['foto_profil'] ?>"
            class="mx-auto d-block shadow-sm img-fluid"
            alt="cs"
          />
          <h5 class="mt-3"><?= $rowprofile['nama_sales'] ?></h5>
          <p>
            Kami siap melayani sepenuh hati <br />
            Klik salah satu tombol dibawah ini untuk menghubungi kami
          </p>
          <p>~~~</p>
        </div>
        <div class="col-12"></div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <a href="https://api.whatsapp.com/send?phone=62<?= $rowprofile['wa'] ?>">
            <button class="btn whatsapp">
              <em class="fa fa-whatsapp"></em>Whatsapp
            </button></a
          >
        </div>
        <div class="col-sm-6">
          <a href="https://www.instagram.com/<?= $rowprofile['ig'] ?>"
            ><button class="btn instagram">
              <em class="fa fa-instagram"></em>Instagram
            </button></a
          >
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <a href="https://www.facebook.com/<?= $rowprofile['fb'] ?>"
            ><button class="btn facebook">
              <em class="fa fa-facebook"></em>Facebook
            </button></a
          >
        </div>
        <div class="col-sm-6">
          <a href="index">
            <button class="btn website">
              <em class="fa fa-globe"></em>Website
            </button></a
          >
        </div>
      </div>
    </div>
    <!-- Akhir Kontak -->
    <section id="galeri">
      <div class="container mt-3 mb-3 info-galeri">
        <div class="row mt-2">
        <div class="col">
            <div
              id="carouselExampleControls"
              class="carousel slide"
              data-bs-ride="carousel"
            >
              <div class="carousel-inner">
              <?php  
              $no = 0;
              while($row = mysqli_fetch_assoc($querygaleri)){
                $no += 1;
                $hasil = $no == 1 ? 'active' : '';
              ?>
                <div class="carousel-item <?= $hasil ?>">
                  <img src="../<?= $row['foto_galeri'] ?>" class="d-block w-100" alt="..." />
                </div>
              <?php } ?>
              </div>

              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleControls"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleControls"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="footer">
      <div class="footer">
        <p>support by <a href="https://galeriide.com">galeriide.com</a></p>
      </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
    <script src="js/animationText.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
  </body>
</html>
