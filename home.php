<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
  echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
?>

    <!-- Akhir Navbar -->
    <section id="admin">
      <div class="container home-admin">
        <div class="row text-center">
          <!-- sALES FITUR -->
          <?php  
          $querypenjualan = mysqli_query($conn, "SELECT tgl_daftar FROM data_penjualan WHERE nama_customer='$rowakun[username]'");
          if(mysqli_num_rows($querypenjualan)){
            $rowtgl = mysqli_fetch_assoc($querypenjualan);
            $array = explode("-",$rowtgl['tgl_daftar']);
            $thndb = $array[0];
            $thnnow = date("Y");
            if($thndb < $thnnow){

            }
          ?>
            <div class="alert alert-danger" role="alert">
              Masa Pakai anda berakhir, Segera hubungi Admin untuk melakukan pembayaran!
            </div>
          <?php } ?>
          <h5>HAI KAK <?= strtoupper($rowakun['username'])  ?></h5>
          <p>Semoga penjualan bulan ini melebihi target yah. Aamiin</p>
          <div class="col-4 col-md-3 mt-3">
            <a href="slider-home"> <img src="img-admin/kontak.png" class="img-fluid mx-auto d-block" alt="slider" /></a>
            <h6>EDIT HOME</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="data-profile"
              ><img src="img-admin/profile.png" class="img-fluid mx-auto d-block" alt="profile"
            /></a>
            <h6>EDIT PROFILE</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="list-produk"><img src="img-admin/product.png" class="img-fluid mx-auto d-block" alt="produk" /></a>
            <h6>LIST PRODUK</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="list-promo"><img src="img-admin/promo.png" class="img-fluid mx-auto d-block" alt="promo" /></a>
            <h6>LIST PROMO</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="list-galeri"> <img src="img-admin/galeri.png" class="img-fluid mx-auto d-block" alt="galeri" /></a>
            <h6>LIST GALERI</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="simulasi-kredit"> <img src="img-admin/kredit.png" alt="preview" class="img-fluid mx-auto d-block" /></a>
            <h6>SIMULASI KREDIT</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="data-costumer"> <img src="img-admin/costumer.png" alt="preview" class="img-fluid mx-auto d-block" /></a>
            <h6>DAFTAR CUSTOMER</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="edit-akun"
              ><img src="img-admin/akun.png" class="img-fluid mx-auto d-block" alt="akun"
            /></a>
            <h6>EDIT AKUN</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="https://<?= $rowakun['domain'] ?>" target="blank"> <img src="img-admin/preview.png" alt="preview" class="img-fluid mx-auto d-block" /></a>
            <h6>PREVIEW WEBSITE</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="input-seo"
              ><img src="img-admin/seo.png" class="img-fluid mx-auto d-block" alt="akun"
            /></a>
            <h6>SEO</h6>
          </div>
          <div class="col-4 col-md-3 mt-3">
            <a href="kategori-tutorial"> <img src="img-admin/tutorial.png" class="img-fluid mx-auto d-block" alt="preview" /></a>
            <h6>VIDEO TUTORIAL</h6>
          </div>
          <!-- admin -->
          <?php if($rowakun['status'] == 2 || $rowakun['status'] == 3){ ?>
            <div class="col-4 col-sm-3 col-md-3 mt-3">
              <a href="data-penjualan"> <img src="img-admin/penjualan.png" class="img-fluid mx-auto d-block" alt="slider" /></a>
              <h6>DATA PENJUALAN</h6>
            </div>
            <div class="col-4 col-md-3 mt-3">
              <a href="halaman-admin"> <img src="img-admin/userapp.png" class="img-fluid mx-auto d-block" alt="preview" /></a>
              <h6>PANGATURAN ADMIN</h6>
            </div>
          <?php } ?>
        </div>

        <p class="mt-5 mb-3 text-center footer">
          support by
          <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
      </div>
      <div class="col-12 mt-3">&nbsp;</div>
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
