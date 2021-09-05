<?php 
include "header.php";
if($_SESSION['login'] != TRUE){
  echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
$id_merek = $_GET['page'];
?>

    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="home">Home</a></li>
          <li class="breadcrumb-item"><a href="list-produk">Produk</a></li>
          <li class="breadcrumb-item"><a href="edit-merek">Merek</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Input data merek
          </li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
          <h5>INPUT DATA MEREK</h5>
          <?php  
          $queryeditmerek = "SELECT * FROM merek_mobil WHERE id_merek='$id_merek' AND id_admin='$_SESSION[user]'";
          $resultmerek = mysqli_query($conn, $queryeditmerek);
          $row = mysqli_fetch_assoc($resultmerek);
          ?>
          <img <?= $tampil = $id_merek != "" ? 'style="display: block;"' : 'style="display: none;"'  ?> src="<?= $hasil = $id_merek != "" ? $rowakun['domain']."/".$row['foto_merek'] : "" ?>" class="img-fluid" id="image-preview" alt="image preview" />
          <br>
        <form method="post" action="" autocomplete="off" enctype="multipart/form-data">
            <div class="col-12 mt-2">
                <div class="input-group mb-3">
                    <input type="hidden" name="id" value="<?= $id_merek ?>">
                    <input type="hidden" name="editfoto" value="<?= $hasil = $id_merek != "" ? $row['foto_merek'] : '' ?>">
                    <input type="file"  class="form-control" name="fotomobil" id="inputfoto" id="inputGroupFile02" accept="image/png,Image/jpeg" onchange="previewImage();" require />
                </div>
                <p style="font-size: small">
                    *Direkomendasikan Menggunakan File Foto .PNG
                </p>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label" >Nama Merek Mobil</label>
                    <input
                    type="text"
                    class="form-control"
                    name="namamobil"
                    id="exampleFormControlInput1"
                    placeholder="Merek Mobil"
                    value="<?= $hasil = $id_merek != "" ? $row['nama_merek'] : '' ?>"
                    />
                </div>
                <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="Deskripsi tentang merek mobil"
                    name="desk"
                    id="desk"
                    style="height: 100px"
                ><?= $hasil = $id_merek != "" ? $row['desk_merek'] : '' ?></textarea>
                <label for="desk" class="ms-2">Deskirpsi</label>
            </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label" >Video YouTube</label>
                    <input
                    type="text"
                    class="form-control"
                    name="yt"
                    id="exampleFormControlInput1"
                    placeholder="ID YouTube"
                    value="<?= $hasil = $id_merek != "" ? $row['link_yt'] : '' ?>"
                    />
                </div>
                <p style="font-size: small;">
                    Exp: ID Video Youtube <span style="text-decoration: line-through;">https://youtu.be/</span><span style="color: red;">sJhZ3KgEHhs</span>
                </p>
            </div>
        </div>
        <div class="row">
        <?php if($id_merek != ""){ ?>
          <div
            class="col btn-group"
            role="group"
            aria-label="Basic mixed styles example"
            >
            <button type="submit" name="aksieditmerek" class="btn btn-danger btn-save">EDIT</button>
          </div>
          <?php }else{ ?>
          <div
            class="col btn-group"
            role="group"
            aria-label="Basic mixed styles example"
            >
            <button type="submit" name="aksimerekmobil" class="btn btn-danger btn-save">SAVE</button>
          </div>
          <?php } ?>
        </div>
        </form>
        <p class="mt-5 footer">
          support by
          <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
      </div>
    </section>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"
    ></script>
   
    
    <script>
            function previewImage() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("inputfoto").files[0]);
            
                oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").style.display = "block";
                document.getElementById("image-preview").src = oFREvent.target.result;
                };
            };
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
  </body>
</html>
