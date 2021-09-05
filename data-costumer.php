<?php include "header.php"; 
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
                <li class="breadcrumb-item active"><a href="#">Daftar Customer</a></li>
            </ol>
        </nav>
        </div>
        <section id="data-listharga">
            <div class="container">
                <div class="row text-center">

                        <!--<div class="alert alert-warning alert-dismissible fade show" role="alert">-->
                        <!--    <strong>Fitur ini sedang diperbaiki !</strong>-->
                        <!--    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>-->
                        <!--</div>-->
                </div>
                <div class="row">
                <h5>DATA CUSTOMER</h5>
                <p style="font-size:smaller">Menu ini adalah menu untuk mengirim pesan whatsapp ke client anda masing masing.</p>
                <hr>
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-hover" style="font-size: small" >
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">PILIH DATA KATEGORI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td style="font-weight:700"><a href="data-followup">DATA CLIENT WEBSITE</a></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td style="font-weight:700"><a href="data-client">DATA CLIENT MANUAL</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-12 mt-3" >
                    <p style="font-size:smaller">* Data client web adalah data yang terisi otomatis dari form "Konsultasi" dihalaman web anda</p>
                    <p style="font-size:smaller">* Data client manual adalah data yang diupload secara manual atau mengupload data melalui excel, format excel telah kami siapkan.</p>
                </div>
                
                <h5>DAFTAR TEXT PESAN WHATSAPP</h5>
                <hr>
                <div class="col-6 col-sm-3">
                    <button type="button" name="tambahteks" class="btn btn-danger btn-save" data-bs-toggle="modal" data-bs-target="#tambahpesan">+ PESAN</button>
                    <!-- modal -->
                    <div class="modal fade" id="tambahpesan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                            <form class="modal-content" action="" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">TAMBAH TEKS WHATSAPP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="judul" class="form-label">Judul Pesan</label>
                                        <input type="text" name="judulteks" class="form-control" id="judul" placeholder="Contoh : Pesan Promo mingguan" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="isi" class="form-label">Isi Pesan</label>
                                        <textarea class="form-control" name="desk" id="isi"  rows="5" required placeholder="Pesan Anda. . ."></textarea>
                                        <p style="font-size: smaller;">* Masukkan kata kunci <span style="color:#8f0200;"><b>#nama</b></span> jika ingin menyertakan nama customer dipesan</p>
                                        <p style="font-size: smaller;">Contoh: <i>Hai #nama kami ada promo menarik bulan ini</i></p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="aksisimpanteks" class="btn btn-danger btn-save">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-hover" style="font-size: small" >
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">JUDUL TEXT</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  
                            $no = 0;
                            $query = mysqli_query($conn, "SELECT id_teks,judul_teks,teks FROM teks_whatsapp WHERE id_admin='$_SESSION[user]'");
                            while($row = mysqli_fetch_assoc($query)){
                            ?>
                            <tr>
                                <td><?= $no += 1; ?>.</td>
                                <td style="font-weight:700">
                                    <a href="#viewsdetailt<?= $row['id_teks'] ?>" data-bs-toggle="modal"><?= $row['judul_teks'] ?></a>
                                </td>
                                <td>
                                    <a href="#editteks<?= $row['id_teks'] ?>" data-bs-toggle="modal"><span class="material-icons">edit</span></a>
                                    <a href="#deleteteks<?= $row['id_teks'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

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
                                    <?php  
                                    $query = mysqli_query($conn, "SELECT id_teks,judul_teks,teks FROM teks_whatsapp WHERE id_admin='$_SESSION[user]'");
                                    while($row = mysqli_fetch_assoc($query)){
                                    ?>
                                    <!-- modal detail -->
                                    <div class="modal fade" id="viewsdetailt<?= $row['id_teks'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <form class="modal-content" action="" method="post">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">DETAIL TEKS WHATSAPP</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label">Judul Pesan</label>
                                                        <input readonly type="text" name="judulteks" class="form-control" id="judul" value="<?= $row['judul_teks'] ?>" placeholder="Contoh : Pesan Promo mingguan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="isi" class="form-label">Isi Pesan</label>
                                                        <textarea readonly class="form-control" name="desk" id="isi"  rows="5" required placeholder="Pesan Anda. . ."><?= $row['teks'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- modal editteks -->
                                    <div class="modal fade" id="editteks<?= $row['id_teks'] ?>"  data-bs-keyboard="false" tabindex="-1"  aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <form class="modal-content" action="" method="post">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">EDIT TEKS WHATSAPP</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="judul" class="form-label">Judul Pesan</label>
                                                        <input type="text" name="judulteks" class="form-control" id="judul" value="<?= $row['judul_teks'] ?>" placeholder="Contoh : Pesan Promo mingguan" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="isi" class="form-label">Isi Pesan</label>
                                                        <textarea class="form-control" name="desk" id="isi"  rows="5" required placeholder="Pesan Anda. . ."><?= $row['teks'] ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="text" name="id" value="<?= $row['id_teks'] ?>" hidden>
                                                    <button type="submit" name="aksieditteks" class="btn btn-danger btn-save">Simpan</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- modal delete teks -->
                                    <div class="modal fade" id="deleteteks<?= $row['id_teks'] ?>"  data-bs-keyboard="false" tabindex="-1"  aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                            <form class="modal-content" action="" method="post">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">HAPUS TEKS WHATSAPP</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Hapus Pesan <?= $row['judul_teks'] ?> ?
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="text" name="id" value="<?= $row['id_teks'] ?>" hidden>
                                                    <button type="submit" name="aksihapusteks" class="btn btn-danger btn-save">Hapus</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <?php } ?>
    </body>
</html>
<?php mysqli_close($conn) ?>