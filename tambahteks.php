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
          <li class="breadcrumb-item"><a href="data-costumer">Daftar Costumer</a></li>
          <li class="breadcrumb-item active" aria-current="page">
            Input / edit Teks
          </li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
            <h5>INPUT TEKS WHATSAPP</h5>
                <form method="post" action="" autocomplete="off" >
                        <?php  
                        $queryteks = mysqli_query($conn, "SELECT * FROM teks_whatsapp WHERE id_teks='$_POST[text]'");
                        $row = mysqli_fetch_assoc($queryteks);
                        ?>
                        <div class="col-12 mt-2">
                            <div class="input-group mb-3">
                                <input type="hidden" name="id" value="<?= $_POST['text'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="judul" class="form-label" >Judul Teks</label>
                                <input
                                type="text"
                                class="form-control"
                                name="judulteks"
                                id="judul"
                                placeholder="Judul Teks"
                                value="<?= $hasil = isset($_POST['editeks']) ? $row['judul_teks'] : '' ?>"
                                />
                            </div>
                            <div class="form-floating mb-3">
                            <textarea
                                class="form-control"
                                placeholder="Deskripsi tentang merek mobil"
                                name="desk"
                                id="desk"
                                style="height: 300px"
                            ><?= $hasil = isset($_POST['editeks']) ? $row['teks'] : '' ?></textarea>
                            <label for="desk" class="ms-2">Teks</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <?php if(isset($_POST['editeks'])){ ?>
                    <div
                        class="col btn-group"
                        role="group"
                        aria-label="Basic mixed styles example"
                        >
                        <button type="submit" name="aksieditteks" class="btn btn-danger btn-save">EDIT</button>
                    </div>
                    <?php }else{ ?>
                    <div
                        class="col btn-group"
                        role="group"
                        aria-label="Basic mixed styles example"
                        >
                        <button type="submit" name="aksisimpanteks" class="btn btn-danger btn-save">SAVE</button>
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
    <!-- Option 2: Separate Popper and Bootstrap JS -->
  </body>
</html>
