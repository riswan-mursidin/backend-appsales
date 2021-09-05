<?php 
function showType($id_merek){
  include "koneksi.php";
  $querytype = "SELECT * FROM type_mobil WHERE id_merek='$id_merek'";
  $resulttype = mysqli_query($conn, $querytype);
  while($rowtype = mysqli_fetch_assoc($resulttype)){
    echo "<tr>
    <td>$rowtype[nama_type]</td>
    <td>Rp.".number_format($rowtype['harga_type'],2,',','.')."</td>
    </tr>";
  }
}
include "header.php";
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
          Produk
          </li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
          <h5>LIST DATA PRODUK</h5>
          <?php  
          $querymerek = "SELECT * FROM merek_mobil WHERE id_admin = '$_SESSION[user]'";
          $resultmerek = mysqli_query($conn, $querymerek);
          if(mysqli_num_rows($resultmerek) == 0){
            echo  '<p>Produk anda masih kosong, silahkan <a href="data-merek"> klik disini untuk menambah produk</a></p>';
          }else{
            echo '<div class="row">
            <div
              class="col-6 mb-5"
              role="group"
              aria-label="Basic mixed styles example"
            >
              <a href="data-merek" class="btn mt-3 btn-danger btn-edit">
                + Merek 
              </a>
            </div>
            <div class="col-6 mb-5" >
              <a href="edit-merek" class="btn mt-3 btn-danger btn-save">
                List Merek
              </a>
            </div>
        </div>';
          }
          ?>
         
          <div class="row mt-3">
            <?php  
            while($rowmerek = mysqli_fetch_assoc($resultmerek)){
            ?>
            <div class="col-12 col-sm-6 mt-3">
              <img
                src="<?=$rowakun['domain']."/".$rowmerek['foto_merek'] ?>"
                class="img-fluid"
                alt="almaz"
              />
              <div class="judul-merek"><h6><?= strtoupper($rowmerek['nama_merek']) ?></h6></div>
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">TYPE</th>
                    <th scope="col">HARGA RP.</th>
                  </tr>
                </thead>
                <tbody>
                  <?= showType($rowmerek['id_merek'])  ?>
                </tbody>
              </table>

              <div
                class="col btn-group mb-5"
                role="group"
                aria-label="Basic mixed styles example"
                style="margin-top: -10px"
              >
                <a href="list-type?page=<?= $rowmerek['id_merek'] ?>" class="btn btn-danger btn-save">
                  TAMBAH / EDIT TYPE
                </a>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="col-12">
                <p class="mt-5 mb-5  footer">
                  support by
                  <a style="color: black" href="https://galeriide.com">galeriide.com</a>
                </p>
          </div>
        </div>
      </div>
      	
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