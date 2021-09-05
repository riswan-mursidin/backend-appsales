<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
?>
<!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Home</a></li>
          <li class="breadcrumb-item active"><a href="#">Kategori Tutorial</a></li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
<!-- Pilih kategori -->
<section id="kategori-tutorial">
  <div class="container">
      <div class="row">
          <div class="col-12 mb-3">
              <img class="img-fluid mx-auto d-block rounded" src="img-admin/tutorial-admin.png" alt="">
          </div>
          <div class="col-12"><table class="table table-striped table-hover">
              <h5>Pilih Tutorial</h5>
                <thead>
                  <tr>
                    <th scope="col">KATEGORI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                  $querykat = mysqli_query($conn, "SELECT * FROM kategori_video");
                  while($rowkat = mysqli_fetch_assoc($querykat)){
                  ?>
                    <tr>
                      
                      <td><a href="tutorial?page=<?= $rowkat['id_kategori'] ?>"><?= $rowkat['nama_kategori'] ?></a></td>
                      
                    </tr>      
                  <?php } ?>          
                </tbody>
              </table></div>
      </div>
  </div>
</section>
<!-- akhir pilih kategori -->


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