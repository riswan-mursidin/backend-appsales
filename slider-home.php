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
                    <li class="breadcrumb-item active"><a href="#">Edit Home</a></li>
                </ol>
            </nav>
        </div>
        <!-- Akhir Breadcrumb -->
        <section id="data-listharga">
            
            <form method="post" action="" autocomplete="off" class="container" enctype="multipart/form-data">
                <div class="row">
                <?php  
                $queryporfil = "SELECT perkenalan,keunggulan,kata_sambutan,logo,tema_webside FROM profil_admin WHERE id_admin='$_SESSION[user]'";
                $resultprofil = mysqli_query($conn, $queryporfil);
                $rowprofil = mysqli_fetch_array($resultprofil);
                ?>
                <h5>PILIH TEMA</h5>
                <div class="col-12 col-sm-12 mb-3">
                    <select class="form-select" name="warna" id="">
                        <?php  
                        $warna = array('default','red','blue','green','orange','pink');
                        if($rowprofil['tema_webside'] != ""){
                            echo '<option value="" disabled hidden>PILIH TEMA</option>';
                            for($i = 0; $i < count($warna); $i++){
                                $select = $warna[$i] == $rowprofil['tema_webside'] ? 'selected="selected"' : '';
                                echo '<option value="'.$warna[$i].'"'.$select.'>'.ucfirst($warna[$i]).' Color</option>';
                            }
                        }else{
                            echo '<option value="" disabled selected hidden>PILIH TEMA</option>';
                            for($i = 0; $i < count($warna); $i++){
                                echo '<option value="'.$warna[$i].'">'.ucfirst($warna[$i]).' Color</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <h5>EDIT LOGO</h5>
                <div class="mb-3" style="align-content: center;">
                    <img <?= $tampil = $rowprofil['logo'] != "" ? 'style="display: block;"' : 'style="display: none;"'  ?> src="<?= $hasil = $rowprofil['logo'] != "" ? $rowakun['domain']."/".$rowprofil['logo'] : "" ?>" class="img-fluid" id="image-preview" alt="image preview" />
                </div>
                <input type="hidden" name="editfoto" value="<?= $hasil = $rowprofil['logo'] != "" ? $rowprofil['logo'] : '' ?>">
                <div class="mb-3">
                    <input type="file" class="form-control" name="logo" id="inputfoto" accept="image/png" onchange="previewImage();" />
                </div>
                <h5>EDIT DATA TEKS</h5>
                    <div class="form-floating mb-1">
                        
                        <textarea
                            class="form-control"
                            placeholder="Create your bio"
                            name="perkenalan"
                            id="perkenalan"
                            style="height: 200px"
                            ><?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['perkenalan'] : "" ?></textarea>
                        <label for="pengantar" class="ms-2">Kata Perkenalan</label>
                        <p style="font-size: 10px;">Contoh: Halo, Nama Saya andini...</p>
                    </div>
                    <div class="form-floating mb-1">
                        <textarea
                            class="form-control"
                            placeholder="Create your bio"
                            name="keunggulan"
                            id="keunggulan"
                            style="height: 200px"
                        ><?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['keunggulan'] : "" ?></textarea>
                        <label for="pengantar" class="ms-2">keunggulan</label>
                        <p style="font-size: 10px;">Contoh: DP Terjangkau & Angsuran Bungan Ringan, Bonus Gratis aksesoris pilihan</p>
                    </div>
                    <div class="form-floating mb-1">
                        <textarea
                            class="form-control"
                            placeholder="Create your bio"
                            name="pengantar"
                            id="pengantar"
                            style="height: 100px"
                        ><?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['kata_sambutan'] : "" ?></textarea>
                        <label for="pengantar" class="ms-2">Kata Sambutan</label>
                        <p style="font-size: 10px;">Contoh: Selamat datang di website kami</p>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div
                                class="col btn-group"
                                role="group"
                                aria-label="Basic mixed styles example"
                            >
                                <button type="submit" name="aksiteks" class="btn btn-danger btn-save">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container mt-3">
                <div class="row">
                <h5>EDIT DATA SLIDER</h5>
                <div class="col-12">
                    <table
                    class="table table-striped table-hover"
                    style="font-size: small"
                    >
                    <thead>
                        <tr>
                        <th scope="col">GAMBAR</th>
                        <th scope="col">DESKRIPSI</th>
                        <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    $queryslider = "SELECT * FROM slider_home WHERE id_admin = '$_SESSION[user]' ORDER BY id_slider ASC";
                    $resultslider = mysqli_query($conn, $queryslider);
                    while($row = mysqli_fetch_assoc($resultslider)){
                    ?>
                        <tr>
                        <td>
                            <img
                            src="<?php echo $rowakun['domain']."/".$row['foto_slider'] ?>"
                            width="100px"
                            alt="merek"
                        />
                        </td>
                        <td><?php echo $row['desk'] ?></td>
                        <td>
                            <a href="data-slider?page=<?= $row['id_slider'] ?>"><span class="material-icons">edit</span></a>
                            <a href="#hapusslider<?= $row['id_slider'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusslider<?= $row['id_slider'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Slider!</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus slider dari daftar?<br>
                                        </div>
                                        <form method="post" action="" class="modal-footer">
                                            <input type="hidden" name="idslider" value="<?= $row['id_slider'] ?>"">
                                            <button type="submit" name="hapusslider" class="btn btn-danger btn-save">Ya</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>
                </div>
                <div class="row">
                <div
                    class="col-12 btn-group"
                    role="group"
                    aria-label="Basic mixed styles example"
                >
                    <a href="data-slider"
                    ><button type="button"  class="btn btn-danger btn-save">
                        TAMBAH SLIDER
                    </button></a>
                </div>
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
    </body>

</html>
<?php mysqli_close($conn) ?>