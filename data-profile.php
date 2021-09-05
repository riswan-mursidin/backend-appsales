<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
  echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
$queryporfil = "SELECT * FROM profil_admin WHERE id_admin='$_SESSION[user]'";
$resultprofil = mysqli_query($conn, $queryporfil);
$rowprofil = mysqli_fetch_assoc($resultprofil);
?>
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Edit Profile</a></li>
            </ol>
        </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <!-- Akhir Navbar -->
    <section id="data-listharga">
        <form form method="post" action="" autocomplete="off" enctype="multipart/form-data" class="container">
            <div class="row">
                <div class="col-12 col-sm-3">
                    <h5>INPUT DATA KONTAK</h5>
                </div>
                <div class="col-12 col-sm-6">
                    <div class="input-group mb-5">
                            <input
                                type="text"
                                class="form-control"
                                id="myInput"
                                value="<?= $rowakun['domain'] ?>/kontak"
                                aria-describedby="basic-addon3"
                                placeholder="domain.com"
                                disabled
                            />
                            <span
                        class="input-group-text"
                        id="myInput"
                        style="font-size: small"
                        > <button type="button" onclick="myFunction()" style="text-decoration: none;border:none;">Copy</button> </span
                    >
                    </div>
    
                </div>
            <hr />
            <img
            src="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowakun['domain']."/".$rowprofil['foto_profil'] : $rowakun['domain']."/img/profile/cs-default.png" ?>"
            class="mx-auto d-block mt-3 mb-3"
            id="preview" 
            alt="image preview"
            style="max-width: 200px; border-radius: 100%"
            alt="profile"
            />
            <div class="col-12">
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="crop_image" id="upload_image" accept="image/png,Image/jpeg" onchange="previewImage();" require  />
                </div>
            </div>
            
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="namasales"
                    name="namasales"
                    value="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['nama_sales'] : "" ?>"
                    placeholder="Nama Lengkap"
                />
                <label for="floatingInput" id="namasales" class="ms-2">Nama Sales</label>
            </div>
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="jabatan"
                    name="jabatan"
                    value="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['jabatan_sales'] : "" ?>"
                    placeholder="Jabatan Sales"
                />
                <label for="floatingInput" id="jabatan" class="ms-2">Jabatan Sales</label>
            </div>
            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="cabang"
                    name="cabang"
                    value="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['cabang'] : "" ?>"
                    placeholder="Nama Lengkap"
                />
                <label for="cabang" id="cabang" class="ms-2">Nama Perusahaan</label>
            </div>
            <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="Alamat cabang Wuling"
                    name="alamat"
                    id="alamat"
                
                    style="height: 100px"
                ><?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['alamat'] : "" ?></textarea>
                <label for="alamat" class="ms-2">Alamat</label>
            </div>
            <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    placeholder="Create your bio"
                    name="bio"
                    id="bio"
                    style="height: 100px"
                ><?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['bio'] : "" ?></textarea>
                <label for="bio" class="ms-2">Bio</label>
            </div>
            <label class="form-label mt-3">Kontak</label>
            <hr>
            <label for="fb" class="form-label mt-3">Facebook</label>
            <div class="input-group mb-3">
            <span
                class="input-group-text"
                id="fb"
                style="font-size: small"
                >https://facebook.com/</span
            >
            <input
                type="text"
                class="form-control"
                id="fb"
                name="fb"
                value="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['fb'] : "" ?>"
                aria-describedby="basic-addon3"
                placeholder="username"
            />
            </div>
            <label for="wa" class="form-label mt-1">Whatsapp</label>
            <div class="input-group mb-3">
            <span
                class="input-group-text"
                id="wa"
                style="font-size: small"
                >+62</span
            >
            <input
                type="number"
                class="form-control"
                id="wa"
                name="wa"
                value="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['wa'] : "" ?>"
                aria-describedby="basic-addon3"
                placeholder="8xxxxxx"
            />
            </div>
            <label for="ig" class="form-label mt-1">Instagram</label>
            <div class="input-group mb-3">
            <span
                class="input-group-text"
                id="ig"
                style="font-size: small"
                >https://instagram.com/</span
            >
            <input
                type="text"
                class="form-control"
                id="ig"
                name="ig"
                value="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['ig'] : "" ?>"
                aria-describedby="basic-addon3"
                placeholder="username"
            />
            </div>
            <label for="link" class="form-label mt-1">Website</label>
            <div class="input-group mb-5">
            <span
                class="input-group-text"
                id="link"
                style="font-size: small"
                >www.</span
            >
                    <input
                        type="text"
                        class="form-control"
                        id="link"
                        name="link"
                        value="<?= $hasil = mysqli_num_rows($resultprofil) > 0 ? $rowprofil['link'] : "" ?>"
                        aria-describedby="basic-addon3"
                        placeholder="domain.com"
                    />
            </div>

            <div class="row">
            <div
                class="col btn-group"
                role="group"
                aria-label="Basic mixed styles example"
            >
                <button type="submit" name="aksiprofil" class="btn btn-danger btn-save">SAVE</button>
            </div>
            </div>
        </form>
        <p class="mt-5 footer text-center">
            support by
            <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
        <div class="mt-3 mb-5">&nbsp;</div>
        </section>
        <!-- modal -->
        <div class="modal" tabindex="-1" id="modal_crop">
        <div class="modal-dialog" style="max-width: 1000px !important;">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crop Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                <div class="row">
                    <div class="col-md-8 col-11">
                    <img src="" id="sample_image" class="img-fluid mx-auto d-block" style="max-width: 100%; display:block" alt="">
                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="crop_and_upload" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
        //TOAST
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    Copy Link
                </div>
            </div>
        </div>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"
        ></script>
        <script>
            function myFunction() {
            /* Get the text field */
            var copyText = document.getElementById("myInput");

            /* Select the text field */
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */

            /* Copy the text inside the text field */
            navigator.clipboard.writeText(copyText.value);
            
            /* Alert the copied text */
            var toastLiveExample = document.getElementById('liveToast')
            var toast = new bootstrap.Toast(toastLiveExample)
            toast.show()
            }
        </script>
        

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        </body>
    </html>
    <?php mysqli_close($conn) ?>
