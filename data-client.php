<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
$batas = 5;
$halaman = $_GET['halaman'];
?>
    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="data-costumer">Data Customer</a></li>
                <li class="breadcrumb-item active"><a href="#">Daftar Client</a></li>
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
                <h5>TEXT PESAN WHATSAPP</h5>
                <p>Tambah atau Edit pesan anda. </p>
                <form method="post" action="tambahteks" class="row">
                    <div class="col-12 mb-3">
                        <select  name="text" id="text" class="form-select" onchange="mySelect()">
                            <option disabled selected>Pilih Teks</option>
                            <?php  
                            $querytext = mysqli_query($conn, "SELECT * FROM teks_whatsapp WHERE id_admin=$_SESSION[user]");
                            while($rowteks = mysqli_fetch_assoc($querytext)){
                            ?>
                            <option value="<?= $rowteks['id_teks'] ?>"><?= $rowteks['judul_teks'] ?></option>
                            <?php } ?>
                        </select>
                        <p style="font-size:smaller">Pilih konsep pesan whatsapp.</p>
                    </div>
                    <!-- <div class="col-6 col-md-6 mb-3">
                        <button type="button" class="btn btn-success">TAMBAH PESAN</button>
                    </div>
                    <div class="col-6 col-md-6 mb-3">
                        <button type="submit" name="editeks" id="editeks" class="btn btn-warning" style="cursor: not-allowed;" disabled>EDIT PESAN</button>
                    </div> -->
                </form>
                    <div class="col-6 col-md-8">
                        <h5>DATA CUSTOMER</h5>
                    </div>
                    <div class="col-6 col-md-4 mb-3">
                        <input type="search" class="form-control light-table-filter" onkeyup="showCustomer(this.value)" placeholder="Mencari..." />
                    </div>
                <hr>
                <div class="col-12 table-responsive">
                    <table class="table table-striped table-hover" style="font-size: small" >
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NAME</th>
                                <th scope="col">WhatsApp</th>
                                <th scope="col">ALAMAT</th>
                                <th scope="col">FOLLOW UP</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                    <tbody id="txtHint">
                        <?php  
                        if(empty($halaman)){
                            $posisi = 0;
                            $halaman = 1;
                        }else{
                            $posisi = ($halaman-1) * $batas;
                        }
                        $querycostumer = "SELECT id_costumer,nama_costumer,no_costumer,kota_costumer FROM costumer WHERE kategori='1' AND id_admin = '$_SESSION[user]' ORDER BY kota_costumer DESC LIMIT $posisi,$batas";
                        $i = $posisi+1;
                        $resultcostumer = mysqli_query($conn, $querycostumer);
                        while($row = mysqli_fetch_assoc($resultcostumer)){
                        ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $row['nama_costumer'] ?></td>
                                <td><?= $row['no_costumer'] ?></td>
                                <td><?= $row['kota_costumer'] ?></td>
                                <td> 
                                    <a href="#wa<?= $row['id_costumer'] ?>" data-bs-toggle="modal"><span class="material-icons">send</span></a>
                                </td>
                                <td>
                                    <a href="#editcostumer<?= $row['id_costumer'] ?>" data-bs-toggle="modal"><span class="material-icons">edit</span></a>
                                    <a href="#hapuscostumer<?= $row['id_costumer'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <input type="hidden" id="angka" value="<?= $i ?>">
                    </table>
                    <div class="row">
                        <form action="tambahdata-costumer" method="post" class="col-6 col-md-9 mb-3">
                            <button style="max-width: 200px;" type="submit" class="btn btn-danger btn-save">+ Data Customer</button>
                        </form>
                        <div class="col-6 col-md-3 ">
                            <nav aria-label="Page navigation example">
                                <ul  class="pagination">
                                <?php  
                                    if($halaman-1 != 0 ){
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="data-client?halaman=<?= $halaman-1 ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php  
                                        $query2 = mysqli_query($conn, "SELECT id_costumer FROM costumer WHERE kategori='1' AND id_admin = '$_SESSION[user]'");
                                        $jmldata = mysqli_num_rows($query2);
                                        $jmlhalaman = ceil($jmldata/$batas);
                                        for($j=1; $j<=$jmlhalaman; $j++){
                                            if($j != $halaman){
                                                echo '<li class="page-item"><a class="page-link" href="data-client?halaman='.$j.'">'.$j.'</a></li>';
                                            }else{
                                                echo '<li class="page-item"><a class="page-link" href="#">'.$j.'</a></li>';
                                            }
                                        }
                                    ?>
                                    

                                    <?php  
                                    if($halaman < $jmlhalaman){
                                    ?>
                                    <li class="page-item">
                                        <a class="page-link" href="data-client?halaman=<?= $halaman+1 ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                

                <p class="mt-5 footer">
                support by
                <a style="color: black" href="https://galeriide.com">galeriide.com</a>
                </p>
            </div>
        </section>
                                <?php  
                                $querycostumer = "SELECT id_costumer,nama_costumer,no_costumer,kota_costumer FROM costumer WHERE kategori='1' AND id_admin = '$_SESSION[user]' ORDER BY kota_costumer DESC";
                                $i = 0;
                                $resultcostumer = mysqli_query($conn, $querycostumer);
                                while($row = mysqli_fetch_assoc($resultcostumer)){
                                ++$i;
                                ?>
                                <!-- Modal send -->
                                <div class="modal fade" id="wa<?= $row['id_costumer'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="padding: 3px;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Mengirim Pesan!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Kirim Pesan ke <?= $row['nama_costumer'] ?>?
                                                <?php 
                                                $hariini = date("Y-m-d");
                                                $querycos = mysqli_query($conn, "SELECT id_costumer FROM costumer WHERE id_costumer='$row[id_costumer]' AND waktu_send='$hariini'");
                                                if(mysqli_num_rows($querycos) > 0){
                                                    echo '<p style="font-size: smaller;">Anda sudah mengirim pesan ke kontak ini, pada hari ini</p>'; 
                                                }
                                                ?>
                                            </div>
                                            <form class="modal-footer" method="post" action="" >
                                                <input type="hidden" name="no" value="<?= $row['no_costumer'] ?>">
                                                <input type="hidden" name="id" value="<?= $row['id_costumer'] ?>">
                                                <input type="hidden" id="teksinput<?= $i ?>" name="teksinput" >
                                                <input type="hidden" name="namakontak" value="<?= $row['nama_costumer'] ?>">
                                                <button type="submit" name="kirimwa" id="kirimwa<?= $i ?>" disabled class="btn btn-danger">Ya</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal edit -->
                                <div class="modal fade" id="editcostumer<?= $row['id_costumer'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <form class="modal-content" action="" method="post">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Costumer</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Costumer</label>
                                                    <input type="text" name="nama" class="form-control" id="nama" value="<?= $row['nama_costumer'] ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="wa" class="form-label">WhatsApp</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="wa">+62</span>
                                                        <input type="number" value="<?= $row['no_costumer'] ?>" name="wa" class="form-control" placeholder="example : 821xxx">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kota" class="form-label">Kota Asal</label>
                                                    <input type="text" value="<?= $row['kota_costumer'] ?>" name="kota" class="form-control" id="kota">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" value="<?= $row['id_costumer'] ?>" name="id">
                                                <button type="submit" name="aksicostumeredit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Modal hapus -->
                                <div class="modal fade" id="hapuscostumer<?= $row['id_costumer'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" style="padding: 3px;">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Menghapus Costumer!</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin menghapus Costumer?<br>
                                            </div>
                                            <form class="modal-footer" method="post" action="">
                                                <input type="hidden" name="idcostumer" value="<?= $row['id_costumer'] ?>">
                                                <button type="submit" name="hapuscostumer2" class="btn btn-danger">Ya</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>

        <script>
            function mySelect(){
                var a = document.getElementById("angka").value;
                var x = document.getElementById("text").value;
                var i;
                for(i = 1; i <= a; i++){
                    document.getElementById("teksinput"+i).value = x;
                    document.getElementById("kirimwa"+i).disabled = false;
                }
                var t = document.getElementById("editeks");
                t.disabled = false;
                t.style.cursor = "pointer";
            }
        </script>
        <script>
            function showCustomer(str) {
                if (str == "") {
                    return;
                }
                const xhttp = new XMLHttpRequest();
                xhttp.onload = function() {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
                xhttp.open("GET", "getclient.php?q="+str);
                xhttp.send();
            }
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