<?php include "header.php";
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
$id_type = $_GET['page'];
/// merek select jika edit
$queryedittype = "SELECT * FROM type_mobil WHERE id_type='$id_type'";
$resulttype = mysqli_query($conn, $queryedittype);
$row = mysqli_fetch_assoc($resulttype);
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
          <li class="breadcrumb-item"><a href="list-type?page=<?= $_SESSION['merek_id'] ?>"> Type</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Input Type
          </li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
          <h5>INPUT/EDIT DATA TYPE</h5>
          <hr />

          <form action="" method="post" autocomplete="off">
            <div class="col-12">
              <!-- id merek mobil untuk type -->
              <input type="hidden" name="merekmobil" value="<?= $_SESSION['merek_id'] ?>">
            <div class="mb-3 mt-33">
              <label for="" class="form-label">Merek Mobil</label>
              <select class="form-select" name="" id="" disabled style="cursor:not-allowed">
                <option value=""><?= $rowmerek['nama_merek'] ?></option>
              </select>
            </div>
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >Type Merek Mobil</label
                >
                <input
                  type="text"
                  name="typemobil"
                  value="<?= $hasil = $id_type != "" ? $row['nama_type'] : "" ?>"
                  class="form-control"
                  id="exampleFormControlInput1"
                  placeholder="Type"
                />
              </div>
              <div class="mb-3 mt-3">
                <label for="exampleFormControlInput1" class="form-label"
                  >Harga</label
                >
                <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Rp.</span>
                  <input type="number" name="harga" class="form-control" placeholder="00.0" value="<?= $hasil = $id_type != "" ? $row['harga_type'] : "" ?>">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div
              class="col-4 btn-group"
              role="group"
              aria-label="Basic mixed styles example"
            >
              <?php if($id_type != ""){ ?>
                <input type="hidden" name="id" value="<?= $row['id_type'] ?>">
                <button type="submit" name="aksitypeedit" class="btn btn-danger btn-save">EDIT</button>
              <?php }else{ ?>
                <button type="submit" name="aksitypemobil" class="btn btn-danger btn-save">SAVE</button>
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