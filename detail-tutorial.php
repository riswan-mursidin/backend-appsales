<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}

$id = $_GET['page'];
if($id == ""){
  echo "<script type='text/javascript'>document.location.href = 'kategori-tutorial';</script>";
}
$queryvideo = mysqli_query($conn, "SELECT * FROM video_tutorial WHERE id_video='$id'");
$rowvideo = mysqli_fetch_assoc($queryvideo);
?>
<!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home">Home</a></li>
          <li class="breadcrumb-item"><a href="kategori-tutorial">Kategori</a></li>
          <li class="breadcrumb-item"><a href="tutorial">Tutorial</a></li>
          <li class="breadcrumb-item active"><a href="#">Detail</a></li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
<!-- Pilih kategori -->
<section id="detail-tutorial">
  <div class="container">
      <div class="row">
        <div class="col-12">
          <iframe
            class="video-frame"
            src="https://www.youtube.com/embed/<?= $rowvideo['file_video'] ?>"
            title="YouTube video player"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
          ></iframe>
          <h5 class="mt-2"><?= $rowvideo['judui_video'] ?></h5>
          <hr>
      </div>
      <div class="col-12" style="text-align: justify;">
          <p><?= $rowvideo['desk_video'] ?></p>
      </div>
      <div class="col-6 mt-3">
          <a href="kategori-tutorial"><button type="button" class="btn btn-secondary">Tutorial lainnya</button></a>
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