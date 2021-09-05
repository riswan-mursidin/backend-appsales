<?php include "header.php"; 
if($_SESSION['login'] != "true"){
  header('Location: index');
}

function showJumlahwarna($id){
    include "koneksi.php";
    $jumlah = 0;
    $querywarna = mysqli_query($conn, "SELECT id_warna FROM warna_merek WHERE id_merek='$id'");
    while($rowwarna = mysqli_fetch_assoc($querywarna)){
        $jumlah += 1;
    }
    return $jumlah;
}

?>
<!-- Akhir Navbar -->
<!-- Breadcrumb -->
<div class="container mt-5 mb-3 breadcrumb-style mt-3">
    <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Addsense</a></li>
        </ol>
    </nav>
</div>
<!-- Akhir Breadcrumb -->
<section id="data-listharga">
    <div class="container">
        <div class="row">
            <h5>EDIT DATA ADDSENSE</h5>

            <div class="col-12">
                <table class="table table-striped table-hover" style="font-size: small">
                    <thead>
                        <tr>
                            <th scope="col">GAMBAR</th>
                            <th scope="col">DESK</th>
                            <th scope="col">SEND</th>
                            <th scope="col">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
              
              $query = "SELECT * FROM addsense WHERE id_admin = '$_SESSION[user]'";
              $result = mysqli_query($conn, $query);
              while($row = mysqli_fetch_assoc($result)){
              ?>
                        <tr>
                            <td>
                                <a href="list-highlight?page=<?= $row['id_merek'] ?>">
                                    <img src="<?= $row['foto'] ?>" width="100px"
                                        alt="merek" />
                                </a>
                            </td>
                            <td><?= $row['ket'] ?></td>

                            <td>
                                <a href="#sendaddsense<?= $row['id'] ?>" data-bs-toggle="modal"><span class="material-icons">send</span></a>
                                <!-- Modal -->
                                <div class="modal fade" id="sendaddsense<?= $row['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form action="" method="post" class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Send Addsens</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <select name="sales" required class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                    <option selected>Pilih Sales yang di tujuh.</option>
                                                    <?php  
                                                    $queryadmin = mysqli_query($conn, "SELECT id_admin,username FROM admin WHERE status='1'");
                                                    while($rowadmin = mysqli_fetch_assoc($queryadmin)){
                                                        echo '<option value="'.$rowadmin['id_admin'].'">'.$rowadmin['username'].'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" name="addsense" class="btn btn-primary">Kirim</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
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
            <div class="col-12 btn-group" role="group" aria-label="Basic mixed styles example">
                <a href="data-merek">
                    <button type="button" class="btn btn-danger btn-save">
                        TAMBAH ADDSENSE
                    </button>
                </a>
            </div>
        </div>


        <p class="mt-5 footer">
            support by
            <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
    </div>
</section>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
</body>

</html>
<?php mysqli_close($conn) ?>