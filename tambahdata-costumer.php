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
                <li class="breadcrumb-item"><a href="data-costumer">Data Costumer</a></li>
                <li class="breadcrumb-item"><a href="data-client">Daftar Client</a></li>
                <li class="breadcrumb-item active"><a href="#">Tambah / Edit Costumer</a></li>
            </ol>
        </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <!-- Akhir Navbar -->
    <section id="data-listharga">
        <form method="post" action=""  enctype="multipart/form-data" class="container">
            <div class="row">
                <h5>Upload Data Costumer</h5>
                <hr>
                <div class="col-12 col-sm-12 mb-3">
                    <label for="excel" class="form-label">Upload File Excel</label>
                    <input class="form-control form-control-sm" name="dataexcel" id="excel" type="file">
                    <div id="exceldesk" class="form-text">Download terlebih dahulu file excel <a href="img-admin/format_data_costumer.xls">disini!</a> dan isi data.</div>
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <button type="submit" name="uplaodfileexcel" class="btn btn-danger btn-save">SIMPAN</button>
                </div>
            </div>
        </form>
        <form method="post" action="" autocomplete="off" class="container">
            <div class="row">
            <!-- <h5>Upload excel data Costumer</h5>
            <hr /> -->
                <h5>Input Data Costumer</h5>
                <hr>
                <div class="col-12 col-sm-12 mb-3">
                    <label for="nama" class="form-label">Nama Costumer</label>
                    <input type="text" name="nama" class="form-control" id="nama">
                </div>
                <div class="col-12 col-sm-12 mb-3">
                    <label for="wa" class="form-label">WhatsApp</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="wa">+62</span>
                        <input type="number" name="wa" class="form-control" placeholder="example : 821xxx">
                    </div>
                </div>
                <div class="col-12 col-sm-12 mb-3">
                    <label for="kota" class="form-label">Kota Asal</label>
                    <input type="text" name="kota" class="form-control" id="kota">
                </div>
                <div class="col-12 col-sm-6 mb-3">
                    <button type="submit" name="aksisimpankostumer" class="btn btn-danger btn-save">SIMPAN</button>
                </div>
            </div>
        </form>
        <p class="mt-5 footer text-center">
            support by
            <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
        <div class="mt-3 mb-5">&nbsp;</div>
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
