<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
$id = $_GET['page'];
if($id == ""){
  echo "<script type='text/javascript'>document.location.href = 'kategori-tutorial';</script>";
}
?>
<!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Home</a></li>
        <li class="breadcrumb-item"><a href="kategori-tutorial">Kategori</a></li>
        <li class="breadcrumb-item active"><a href="#">Tutorial</a></li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
<!-- Pilih kategori -->
<section id="tutorial">
  <div class="container">
      <div class="row">
          <div class="col-12 mb-3">
              <img class="img-fluid mx-auto d-block rounded" src="img-admin/tutorial-admin.png" alt="">
          </div>
          <div class="col-12"><table class="table table-striped table-hover">
              <h5>PILIH TUTORIAL PANEL ADMIN</h5>
                <thead>
                  <tr>
                    <th style="width: 20%;" scope="col">Img</th>
                    <th scope="col">Tutorial</th>
                  </tr>
                </thead>
                <tbody>
                  <?php  
                  $queryvideo = mysqli_query($conn, "SELECT * FROM video_tutorial WHERE kategori_video='$id'");
                  while($rowvideo = mysqli_fetch_assoc($queryvideo)){
                  ?>
                  <tr>
                    <td><img class="img-fluid d-block" style="max-width: 80px;" src="<?= $rowvideo['thumnail_video'] ?>" alt=""></td>
                    <td><a href="detail-tutorial.php?page=<?= $rowvideo['id_video'] ?>"><?= $rowvideo['judul_video'] ?></a></td>
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