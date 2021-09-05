<?php  
include "header.php";
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
$id_merek = $_GET['page'];
if($id_merek == ""){
    echo "<script type='text/javascript'>document.location.href = 'edit-merek';</script>";
}
$querymerek = "SELECT nama_merek,foto_merek FROM merek_mobil WHERE id_merek = '$id_merek'";
$resulmerek = mysqli_query($conn, $querymerek);
$rowmerek = mysqli_fetch_assoc($resulmerek);
?>
        <!-- Akhir Navbar -->
        <!-- Breadcrumb -->
        <div class="container mt-5 mb-3 breadcrumb-style mt-3">
            <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="list-produk">Home</a></li>
                    <li class="breadcrumb-item"><a href="list-produk">Produk</a></li>
                    <li class="breadcrumb-item"><a href="edit-merek">Merek</a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Highlight
                    </li>
                </ol>
            </nav>
        </div>
        <!-- Akhir Breadcrumb -->
        <section id="data-listharga">
            <div class="container">
                <div class="row">
                    <h5>LIST DATA HIGHLIGHT <?php echo strtoupper($rowmerek['nama_merek']) ?></h5>
                    <div class="col-12 mt-3">
                        <img
                            src="<?php echo $rowakun['domain']."/".$rowmerek['foto_merek'] ?>"
                            style="max-height: 200px"
                            alt="almaz"
                            class="mx-auto d-block"
                        />
                        <div class="judul-merek"><h6><?php echo strtoupper($rowmerek['nama_merek']) ?></h6></div>
                        <table
                            class="table table-striped table-hover"
                            style="font-size: large"
                        >
                            <thead>
                                <tr>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                                $_SESSION['merek_id'] = $id_merek;
                                $queryhighlight = "SELECT * FROM highlight_mobil WHERE id_admin='$_SESSION[user]' AND id_merek='$id_merek'";
                                $resulthighlight = mysqli_query($conn, $queryhighlight);
                                while($rowhighlight = mysqli_fetch_assoc($resulthighlight)){
                                ?>
                                    <tr>
                                        <td>
                                            <img
                                                src="<?php echo $rowakun['domain']."/".$rowhighlight ['foto_highlight'] ?>"
                                                width="100px"
                                                alt="highlight"/>
                                        </td>
                                        <td><?= $rowhighlight['nama_highlight'] ?></td>
                                        <td>
                                            <a href="data-highlight?page=<?= $rowhighlight['id_highlight'] ?>"><span class="material-icons">edit</span></a>
                                            <a href="#hapushighlight<?= $rowhighlight['id_highlight'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                            <!-- Modal -->
                                            <div class="modal fade" id="hapushighlight<?= $rowhighlight['id_highlight'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Menghapus highlight!</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Yakin ingin menghapus highlight?<br>
                                                        </div>
                                                        <form method="post" action="" class="modal-footer">
                                                            <input type="hidden" name="idhighlight" value="<?= $rowhighlight['id_highlight'] ?>"">
                                                            <button type="submit" name="hapushighlight" class="btn btn-danger btn-save">Ya</button>
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
                    <form class="row" action="data-highlight" method="post">
                        <div
                            class="col-12 btn-group"
                            role="group"
                            aria-label="Basic mixed styles example"
                            >
                            <input type="hidden" name="idhighlight" value="<?= $id_highlight ?>">
                            <button type="submit" name="tambahhighlight" class="btn btn-danger btn-save">TAMBAH HIGHLIGHT</button>
                        </div>
                    </form>
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
    </body>
</html>
<?php mysqli_close($conn) ?>