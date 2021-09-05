<?php include "header.php";
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
$id = $_GET['page'];
/// merek select jika edit
$queryeditwarna = "SELECT * FROM warna_merek WHERE id_warna='$id'";
$resultwarna = mysqli_query($conn, $queryeditwarna);
$row = mysqli_fetch_assoc($resultwarna);
$querymerek = mysqli_query($conn, "SELECT nama_merek FROM merek_mobil WHERE id_merek='$_SESSION[merek_id]'");
$rowmerek = mysqli_fetch_assoc($querymerek);
?>


    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="home">Home</a></li>
          <li class="breadcrumb-item"><a href="list-produk">Produk</a></li>
          <li class="breadcrumb-item"><a href="edit-merek"> Merek</a></li>
          <li class="breadcrumb-item"><a href="list-warna?page=<?= $_SESSION['merek_id'] ?>"> Type</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Input Warna
          </li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
          <h5>INPUT/EDIT DATA WARNA</h5>
          <hr />

          <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
          <input type="hidden" name="fotolama" value="<?= $hasil = $id != "" ? "$row[foto_warna]" : "" ?>" id="">
                <img
                    <?= $tampil = $id != "" ? 'style="display: block;"' : 'style="display: none;"'  ?>
                    src="<?= $hasil = $id != "" ? "$rowakun[domain]/$row[foto_warna]" : "" ?>"
                    class="mx-auto img-fluid mt-3 mb-3"
                    id="image-preview" 
                    alt="image preview"
                    style="max-width: 500px;"
                    alt="profile"
                />
                <div class="col-12">
                    <div class="input-group mb-3">
                    <input type="file" class="form-control" name="warnamerek" id="warnamerek" accept="image/png,Image/jpeg" onchange="previewImage();" require  />
                    </div>
                </div>
            <div class="col-12">
              <input type="hidden" name="merek" value="<?= $_SESSION['merek_id']  ?>">
            <label for="" class="form-label">Merek Mobil</label>
              <select class="form-select" name="" id="" disabled style="cursor:not-allowed">
                <option value=""><?= $rowmerek['nama_merek'] ?></option>
              </select>
  
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >Warna mobil</label
                >
                <input
                  type="text"
                  name="warna"
                  value="<?= $hasil = $id != "" ? $row['ket_warna'] : '' ?>"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Warna"
                />
              </div>
            </div>
          </div>
          <div class="row">
            <div
              class="col-4 btn-group"
              role="group"
              aria-label="Basic mixed styles example"
            >
              <?php if($id != ""){ ?>
                <input type="hidden" name="id" value="<?= $id?>">
                <button type="submit" name="aksieditwarna" class="btn btn-danger btn-save">EDIT</button>
              <?php }else{ ?>
                <button type="submit" name="aksisimpanwarna" class="btn btn-danger btn-save">SAVE</button>
              <?php } ?>
            </div>
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
                oFReader.readAsDataURL(document.getElementById("warnamerek").files[0]);
                
                oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").style.display = "block";
                document.getElementById("image-preview").src = oFREvent.target.result;
                };
            };
        </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
  </body>
</html>
<?php mysqli_close($conn) ?>