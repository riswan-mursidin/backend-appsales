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
                <li class="breadcrumb-item active"><a href="#">List Galeri</a></li>
            </ol>
        </nav>
        </div>
        <!-- Akhir Breadcrumb -->
        <section id="data-listharga">
        <div class="container">
            <div class="row">
            <h5>EDIT DATA GALERI</h5>

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
                $querygaleri = "SELECT * FROM galeri_sales WHERE id_admin = '$_SESSION[user]'";
                $resultgaleri = mysqli_query($conn, $querygaleri);
                while($row = mysqli_fetch_assoc($resultgaleri)){
                ?>
                    <tr>
                    <td>
                        <img
                        src="<?php echo $rowakun['domain']."/".$row['foto_galeri'] ?>"
                        width="100px"
                        alt="merek"
                    />
                    </td>
                    <td><?php echo $row['desk'] ?></td>
                    <td>
                        <a href="data-galeri?page=<?= $row['id_galeri'] ?>"><span class="material-icons">edit</span></a>
                        <a href="#hapusgaleri<?= $row['id_galeri'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                        <!-- Modal -->
                        <div class="modal fade" id="hapusgaleri<?= $row['id_galeri'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Menghapus Galeri!</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menghapus Foto galeri dari daftar?<br>
                                    </div>
                                    <form method="post" action="" class="modal-footer">
                                        <input type="hidden" name="idgaleri" value="<?= $row['id_galeri'] ?>"">
                                        <button type="submit" name="hapusgaleri" class="btn btn-danger btn-save">Ya</button>
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
                <a href="data-galeri"
                ><button type="button"  class="btn btn-danger btn-save">
                    TAMBAH GALERI 
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
    </body>
</html>
<?php mysqli_close($conn) ?>