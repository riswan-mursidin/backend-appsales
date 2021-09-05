<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
  }
$id = $_GET['page'];
$querygaleri = "SELECT * FROM galeri_sales WHERE id_galeri = '$id'";
$resultgaleri = mysqli_query($conn, $querygaleri);
$rowgaleri = mysqli_fetch_assoc($resultgaleri);
?>
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="list-galeri">List Galeri</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                input / Edit Galeri
                </li>
            </ol>
        </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <!-- Akhir Navbar -->
        <section id="data-listharga">
        <form method="post" action="" autocomplete="off" enctype="multipart/form-data" class="container">
            <div class="row">
                <h5>INPUT DATA GALERI</h5>
                <hr />
                <input type="hidden" name="fotolama" value="<?= $hasil = $id != "" ? "$rowgaleri[foto_galeri]" : "" ?>" id="">
                <img
                <?= $tampil = $id != "" ? 'style="display: block;"' : 'style="display: none;"'  ?>
                    src="<?= $hasil = $id != "" ? "$rowakun[domain]/$rowgaleri[foto_galeri]" : "" ?>"
                    class="mx-auto mt-3 mb-3"
                    id="image-preview" 
                    alt="image preview"
                    style="max-width: 500px;"
                    alt="profile"
                />
                <div class="col-12">
                    <input type="hidden" name="id" id="" value="<?= $hasil = $id != "" ? "$rowgaleri[id_galeri]" : "" ?>">
                    <div class="input-group mb-3">
                    <input type="file" class="form-control" name="bannergaleri" id="bannerpromo" accept="image/png,Image/jpeg" onchange="previewImage();" require  />
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input
                    type="text"
                    class="form-control"
                    id="promo"
                    name="galeri"
                    value="<?= $hasil = $id != "" ? "$rowgaleri[desk]" : "" ?>"
                    placeholder="Nama Lengkap"
                    />
                    <label for="floatingInput" id="promo" class="ms-2">Deskripsi Galeri</label>
                </div>
            </div>

            <div class="row">
                <?php if($id != ""){ ?>
                    <div
                    class="col btn-group"
                    role="group"
                    aria-label="Basic mixed styles example"
                >
                    <button type="submit" name="aksieditgaleri" class="btn btn-danger btn-save">EDIT</button>
                </div>
                <?php }else{ ?>
                <div
                    class="col btn-group"
                    role="group"
                    aria-label="Basic mixed styles example"
                >
                    <button type="submit" name="aksigaleri" class="btn btn-danger btn-save">SAVE</button>
                </div>
                <div
                    class="col btn-group"
                    role="group"
                    aria-label="Basic mixed styles example"
                >
                    <button type="submit" name="aksigaleri2" class="btn btn-danger btn-save">SAVE & INPUT ULANG</button>
                </div>
                <?php } ?>
            </div>
        </form>
        <p class="mt-5 footer text-center">
            support by
            <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
        <div class="mt-3 mb-5">&nbsp;</div>
        </section>

        <script>
            function previewImage() {
            var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("bannerpromo").files[0]);
                
                oFReader.onload = function(oFREvent) {
                document.getElementById("image-preview").style.display = "block";
                document.getElementById("image-preview").src = oFREvent.target.result;
                };
            };
        </script>
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