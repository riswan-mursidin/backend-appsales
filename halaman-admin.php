<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
if($rowakun['status'] != 2){
    echo "<script type='text/javascript'>document.location.href = 'home';</script>";
}
// function shwWhatsApp($id_admin){
//     include "koneksi.php";
//     $query = mysqli_query($conn,"SELECT wa FROM profil_admin WHERE id_admin='$id_admin'");
//     $row = mysqli_fetch_array($query);
//     echo $row['wa'];
// }

function showKategori($id){
    include "koneksi.php";
    $query = mysqli_query($conn, "SELECT nama_kategori FROM kategori_video WHERE id_kategori='$id'");
    $row = mysqli_fetch_assoc($query);
    echo $row['nama_kategori'];
}
?>
    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Pengaturan Admin</a></li>
            </ol>
        </nav>
        </div>
        <section id="data-listharga">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-sm-12">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#referal">
                            DAFTAR MARKETING
                        </button>
                    </div>

                    <div class="collapse mb-3 mt-3" id="referal">
                        <div class="col-6 col-sm-3 col-md-3 mb-3 mt-3" >
                            <button type="button" class="btn btn-danger btn-save" data-bs-toggle="modal" data-bs-target="#tambahmarketing">+ MARKETING</button>
                        </div>
                        <!-- modal tambah marketing -->
                        <div class="modal fade" id="tambahmarketing" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <form class="modal-content" action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">TAMBAH MARKETING</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="kode" class="form-label">Kode Referal</label>
                                            <input type="text" name="kode" id="kode" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Marketing</label>
                                            <input type="text" name="nama" id="nama" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="aksisimpanmarket" class="btn btn-danger btn-save">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-hover" style="font-size: small;">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Referal</th>
                                        <th scope="col">Nama Marketing</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  
                                $no = 1;
                                $sqlmarket = mysqli_query($conn, "SELECT * FROM data_marketing");
                                while($rowmarket = mysqli_fetch_assoc($sqlmarket)){
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>  
                                        <td><?= $rowmarket['kode'] ?></td>
                                        <td><?= ucfirst($rowmarket['nama']) ?></td>
                                        <td>
                                            <a href="#" data-bs-target="#editmarket<?= $rowmarket['id'] ?>" data-bs-toggle="modal"><span class="material-icons">edit</span></a>
                                            <a href="#" data-bs-target="#hapusmarket<?= $rowmarket['id'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- modal edit/delete marketing -->
                        <?php  
                        $sqlmarket = mysqli_query($conn, "SELECT * FROM data_marketing");
                        while($rowmarket = mysqli_fetch_assoc($sqlmarket)){
                        ?>
                        <div class="modal fade" id="editmarket<?= $rowmarket['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <form class="modal-content" action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">EDIT MARKETING</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="kode" class="form-label">Kode Referal</label>
                                            <input type="text" name="kode" id="kode" class="form-control" value="<?= $rowmarket['kode'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Marketing</label>
                                            <input type="text" name="nama" id="nama" class="form-control" value="<?= $rowmarket['nama'] ?>">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" value="<?= $rowmarket['id'] ?>">
                                        <button type="submit" name="aksieditmarket" class="btn btn-danger btn-save">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="hapusmarket<?= $rowmarket['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <form class="modal-content" action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">HAPUS MARKETING</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus <?= $rowmarket['nama'] ?> dari daftar marketing?
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" value="<?= $rowmarket['id'] ?>">
                                        <button type="submit" name="aksihapusmarket" class="btn btn-danger btn-save">YA</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">TIDAK</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php } ?>

                    <div class="col-12 col-sm-12">
                        <button class="btn btn-primary"  type="button" data-bs-toggle="collapse" data-bs-target="#datasales" aria-expanded="false" aria-controls="collapseExample">
                            EDIT DATA COSTUMER
                        </button>
                    </div>

                    <div class="collapse mb-3 mt-3" id="datasales">
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-hover " style="font-size: small" >
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">USERNAME</th>
                                        <th scope="col">EMAIL</th>
                                        <th scope="col">WhatsApp</th>
                                        <th scope="col">DOMAIN</th>
                                        <th scope="col">STATUS</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php  
                                $queryadmin = "SELECT id_admin,username,email,no_tlp,domain,status FROM admin WHERE status ='0' OR status = '1'";
                                $j = 0;
                                $resultadmin = mysqli_query($conn, $queryadmin);
                                while($row = mysqli_fetch_assoc($resultadmin)){
                                ?>
                                    <tr>
                                        <td><?= ++$j ?></td>
                                        <td><?= $row['username'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><a href="https://api.whatsapp.com/send?phone=62<?= $row['no_tlp'] ?>&text=Hai <?= $row['username'] ?>"><?= $row['no_tlp'] ?></a></td>
                                        <td><a href="https://<?= $row['domain'] ?>"><?= $row['domain'] ?></a></td>
                                        <td>
                                            <?php if($row['status']==0){ ?>
                                                <div class="badge bg-danger" style="width: 6rem;border-radius:3px">
                                                    Tidak Aktif
                                                </div>
                                            <?php }else{ ?>
                                                <div class="badge bg-primary" style="width: 6rem;border-radius:3px">
                                                    Aktif
                                                </div>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="#editadmin<?= $row['id_admin'] ?>" data-bs-toggle="modal"><span class="material-icons">edit</span></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="editadmin<?= $row['id_admin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <form class="modal-content" action="" method="post">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Edit User</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="status" class="col-form-label">Status:</label>
                                                                <select name="status" id="status" class="form-select">
                                                                    <option value="" disabled><b>PILIH STATUS</b></option>
                                                                    <?php
                                                                    $status = array(0,1);
                                                                    for($i = 0; $i < count($status); $i++){
                                                                        $select = $row['status'] == $status[$i] ? 'selected=selected' : '';
                                                                        $teks = $status[$i] == 0 ? 'Tidak Aktif' : 'Aktif';
                                                                        echo '<option value="'.$status[$i].'" '.$select.'>'.$teks.'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="message-text" class="col-form-label">Domain:</label>
                                                                <textarea class="form-control" name="domain" id="message-text"><?= $row['domain'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" value="<?= $row['id_admin'] ?>" name="id">
                                                            <button type="submit" name="aksiuseredit" class="btn btn-primary">Simpan</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <a href="#hapusadmin<?= $row['id_admin'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="hapusadmin<?= $row['id_admin'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Menghapus User!</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin ingin menghapus User?<br>
                                                        </div>
                                                        <form method="post" action="" class="modal-footer">
                                                            <input type="hidden" name="idadmin" value="<?= $row['id_admin'] ?>">
                                                            <button type="submit" name="hapusadmin" class="btn btn-danger btn-save">Ya</button>
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

                    <div class="col-12 col-sm-12">
                        <button class="btn btn-primary"  type="button" data-bs-toggle="collapse" data-bs-target="#kategori" aria-expanded="false" aria-controls="collapseExample">
                            DAFTAR KATEGORI VIDEO
                        </button>
                    </div>

                    <div class="collapse mb-3 mt-3" id="kategori">
                        <div class="col-6 col-sm-3 col-md-3 mb-3 mt-3" >
                            <button type="button" class="btn btn-danger btn-save" data-bs-toggle="modal" data-bs-target="#tambahkategori">+ KATEGORI</button>
                        </div>
                        <!-- modal edit -->
                        <div class="modal fade" id="tambahkategori" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <form class="modal-content" action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">TAMBAH KATEGORI</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Nama Kategori</label>
                                            <input type="text" name="kategori" id="kategori" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="aksisimpankategori" class="btn btn-danger btn-save">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-hover" style="font-size: small;">
                                <thead>
                                    <tr>
                                        <th col="scope">#</th>
                                        <th col="scope">Kategori</th>
                                        <th col="scope">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $querykat = mysqli_query($conn, "SELECT * FROM kategori_video");
                                    while($rowkat = mysqli_fetch_assoc($querykat)){
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $rowkat['nama_kategori'] ?></td>
                                        <td>
                                            <a href="#" data-bs-target="#editkategori<?= $rowkat['id_kategori'] ?>" data-bs-toggle="modal"><span class="material-icons">edit</span></a>
                                            <a href="#" data-bs-target="#hapuskategori<?= $rowkat['id_kategori'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="col-12 col-sm-12">
                        <button class="btn btn-primary"  type="button" data-bs-toggle="collapse" data-bs-target="#video" aria-expanded="true" aria-controls="collapseExample">
                            EDIT DATA VIDEO
                        </button>
                    </div>
                    
                    <div class="collapse mb-3 mt-3" id="video">
                        <div class="col-6 col-sm-3 col-md-3 mb-3 mt-3" >
                            <button type="button" class="btn btn-danger btn-save" data-bs-toggle="modal" data-bs-target="#tambahvideo">+ VIDEO</button>
                        </div>
                        <!-- modal -->
                        <div class="modal fade" id="tambahvideo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <form class="modal-content" action="" method="post" enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">TAMBAH VIDEO</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label">Judul Video</label>
                                            <input type="text" name="judulvideo" class="form-control" id="judul" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="thumbnail" class="form-label">Thumbnail Video</label>
                                            <input type="file" name="nail" id="thumbnail" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="link" class="form-label">Link Video</label>
                                            <input type="text" name="link" id="link" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Kategori Video</label>
                                            <select name="kategori" id="kategori" class="form-select" required>
                                                <option value="" selected='selected' disabled>PILIH KATEGORI</option>
                                                <?php  
                                                $querykat = mysqli_query($conn, "SELECT * FROM kategori_video");
                                                while($rowkat = mysqli_fetch_assoc($querykat)){
                                                ?>
                                                <option value="<?= $rowkat['id_kategori'] ?>"><?= $rowkat['nama_kategori'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="isi" class="form-label">Deskripsi Video</label>
                                            <textarea class="form-control" name="desk" id="isi" rows="5" required placeholder="Deskripsi Video. . ."></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="aksisimpanvideo" class="btn btn-danger btn-save">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 table-responsive">
                            <table class="table table-striped table-hover" style="font-size: small;">
                                <thead>
                                    <tr>
                                        <th col="scope">#</th>
                                        <th col="scope">Judul</th>
                                        <th col="scope">thumbnail</th>
                                        <th col="scope">Kategori</th>
                                        <th col="scope">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $queryvideo = mysqli_query($conn, "SELECT * FROM video_tutorial");
                                    while($rowvideo = mysqli_fetch_assoc($queryvideo)){
                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $rowvideo['judul_video'] ?></td>
                                        <td><img style="max-width: 100px;" src="<?= $rowvideo['thumnail_video'] ?>" alt=""></td>
                                        <td><?= showKategori($rowvideo['kategori_video']) ?></td>
                                        <td>
                                            <a href="#" data-bs-target="#editvideo<?= $rowvideo['id_video'] ?>" data-bs-toggle="modal"><span class="material-icons">edit</span></a>
                                            <a href="#" data-bs-target="#hapusvideo<?= $rowvideo['id_video'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
        <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
                                            <?php
                                            $queryvideo = mysqli_query($conn, "SELECT * FROM video_tutorial");
                                            while($rowvideo = mysqli_fetch_assoc($queryvideo)){
                                            ?>
                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="editvideo<?= $rowvideo['id_video'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog ">
                                                    <form class="modal-content" action="" method="post" enctype="multipart/form-data">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">EDIT VIDEO</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="judul" class="form-label">Judul Video</label>
                                                                <input type="text" name="judulvideo" class="form-control" value="<?= $rowvideo['judul_video'] ?>" id="judul" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="thumbnail" class="form-label">Thumbnail Video</label>
                                                                <input type="hidden" value="<?= $rowvideo['thumnail_video'] ?>" name="filelama">
                                                                <input type="file" name="nail" id="thumbnail" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="link" class="form-label">Link Video</label>
                                                                <input type="text" name="link" id="link" class="form-control" value="<?= $rowvideo['file_video'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="kategori" class="form-label">Kategori Video</label>
                                                                <select name="kategori" id="kategori" class="form-select" required>
                                                                    <option value=""  disabled>PILIH KATEGORI</option>
                                                                    <?php  
                                                                    $dblink = $rowvideo['kategori_video'];
                                                                    $querykatt = mysqli_query($conn, "SELECT id_kategori,nama_kategori FROM kategori_video");
                                                                    while($opsi = mysqli_fetch_assoc($querykatt)){
                                                                        $select = $opsi['id_kategori'] == $dblink ? 'selected="selected"' : '';
                                                                        echo '<option value="'.$opsi['id_kategori'].'"'.$select.'>'.$opsi['nama_kategori'].'</option>';
                                                                    }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="isi" class="form-label">Deskripsi Video</label>
                                                                <textarea class="form-control" name="desk" id="isi" rows="5" required placeholder="Deskripsi Video. . ."><?= $rowvideo['desk_video'] ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <input type="hidden" name="id" value="<?= $rowvideo['id_video'] ?>">
                                                            <button type="submit" name="aksieditvideo" class="btn btn-danger btn-save">Simpan</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- Modal hapus -->
                                            <div class="modal fade" id="hapusvideo<?= $rowvideo['id_video'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content" style="padding: 3px;">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Video!</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin ingin menghapus Video?<br>
                                                        </div>
                                                        <form class="modal-footer" method="post" action="">
                                                            <input type="hidden" name="idvideo" value="<?= $rowvideo['id_video'] ?>">
                                                            <button type="submit" name="hapusvideo" class="btn btn-danger">Ya</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                        <?php
                        $querykat = mysqli_query($conn, "SELECT * FROM kategori_video");
                        while($rowkat = mysqli_fetch_assoc($querykat)){
                        ?>
                        <!-- modal edit -->
                        <div class="modal fade" id="editkategori<?= $rowkat['id_kategori'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <form class="modal-content" action="" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">EDIT KATEGORI</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="kategori" class="form-label">Nama Kategori</label>
                                            <input type="text" name="kategori" id="kategori" value="<?= $rowkat['nama_kategori'] ?>" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="id" value="<?= $rowkat['id_kategori'] ?>">
                                        <button type="submit" name="aksieditkategori" class="btn btn-danger btn-save">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal fade" id="hapuskategori<?= $rowkat['id_kategori'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">HAPUS KATEGORI</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin Ingin Menghapus Kategori?
                                        <p style="font-size: 12px;">Video dari kategori <?= $rowkat['nama_kategori'] ?> Akan ikut terhapus.</p>
                                    </div>
                                    <form method="post" action="" class="modal-footer">
                                        <input type="hidden" name="id" value="<?= $rowkat['id_kategori'] ?>">
                                        <button type="submit" name="aksihapuskategori" class="btn btn-danger btn-save">Ya</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
    </body>
</html>
<?php mysqli_close($conn) ?>