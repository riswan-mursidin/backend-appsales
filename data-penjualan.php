<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
if($rowakun['status'] < 2){
    echo "<script type='text/javascript'>document.location.href = 'home';</script>";
}
?>
    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">Data Penjualan</a></li>
            </ol>
        </nav>
        <section id="data-listharga">
            <div class="container">
                <div class="row">
                    <?php if($rowakun['status'] == 2){ ?>
                    <div class="col-12 col-sm-3 mb-3">
                        <button type="button" class="btn btn-primary" data-bs-target="#tambahcustomer" data-bs-toggle="modal">+MANUAL CUSTOMER</button>
                        <!-- Modal -->
                        <div class="modal fade" id="tambahcustomer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="" method="post" class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Customer</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="market" class="form-label">Nama Marketing</label>
                                            <select name="marketing" required id="marketing" class="form-select">
                                                <option value="" selected>Pilih Marketing</option>
                                                <?php  
                                                $query = mysqli_query($conn, "SELECT * FROM data_marketing");
                                                while($row = mysqli_fetch_assoc($query)){
                                                ?>
                                                <option value="<?= $row['nama'] ?>"><?= ucfirst($row['nama']) ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username Yang Terdaftar</label>
                                            <select name="sales" required class="form-select" id="username">
                                                <option value="" selected="selected">PILIH USERNAME</option>
                                                <?php 
                                                    $queryadminsel = mysqli_query($conn, "SELECT username FROM admin WHERE status='1' ORDER BY username ASC");
                                                    while($rowadminsel = mysqli_fetch_assoc($queryadminsel)){
                                                        $querypenjualan = mysqli_query($conn, "SELECT nama_customer FROM data_penjualan WHERE nama_customer='$rowadminsel[username]'");
                                                        $hidden = mysqli_num_rows($querypenjualan) > 0 ? "hidden" : "";
                                                        echo '<option value="'.$rowadminsel['username'].'" '.$hidden.'>'.ucfirst($rowadminsel['username']).'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="tgl" class="form-label">Tanggal Daftar</label>
                                            <input type="date" name="tgl_daftar" id="tgl"  class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pembayaran" class="form-label" >Metode Pembayaran</label>
                                            <select name="pembayaran" id="pembayaran" class="form-select" onchange="showCredit(this.value)" required>
                                                <option value="" hidden>PILIH METODE</option>
                                                <option value="cash">Cash</option>
                                                <option value="credit">Credit</option>
                                            </select>
                                        </div>
                                        <div class="mb-3" id="jangka" style="display: none;">
                                            <label for="jangka" class="form-label">Jangka Waktu</label>
                                            <select name="jangka" id="jangka" class="form-select" onchange="showKredit(this.value)">
                                                <option value="" selected="selected">PILIH JANGKA WAKTU</option>
                                                <option value="3 Bulan">3 Bulan</option>
                                                <option value="6 Bulan">6 Bulan</option>
                                                <option value="12 Bulan">12 Bulan</option>
                                            </select>
                                        </div>
                                        <div id="tabel-datakredit" class="mb-3"></div>
                                        <div class="mb-3">
                                            <label for="status" class="form-label" >Status Pembayaran</label>
                                            <select name="status" id="status" class="form-select" required disabled>
                                                <option value="" hidden>PILIH STATUS</option>
                                                <option value="1">LUNAS</option>
                                                <option value="2">BELUM LUNAS</option>
                                            </select>
                                        </div>
                                        <div id="transaksi" style="display: none;">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Terbayar</label>
                                                    <div class="input-group col-12 mb-3">
                                                        <span class="input-group-text" >Rp.</span>
                                                        <input type="text" name="terbayar" class="form-control" onkeyup="bayarSisa(this.value)">
                                                    </div>
                                            </div>
                                            <p style="font-size: 10px;" id="sisabayar"></p>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Transaksi Terakhir</label>
                                                <input type="date" name="tgl_bayar" class="form-control">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bonus" class="form-label">Bonus</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" >Rp.</span>
                                                <input type="text" placeholder="Bonus Penjual Website" name="bonus" required id="bonus" onkeyup="showSisa(this.value)" class="form-control">
                                            </div>
                                            <p style="font-size: 10px;" id="sisa"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="aksipenjualan" class="btn btn-primary">Simpan</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover " style="font-size: small" >
                            <thead>
                                <tr>
                                    <th scope="col">MARKETING</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">TANGGAL</th>
                                    <th scope="col">PEMBAYARAN</th>
                                    <!-- <th scope="col">TAGIHAN</th>
                                    <th scope="col">SISA TAGIHAN</th> -->
                                    <!-- <th scope="col">WAKTU</th> -->
                                    <th scope="col">STATUS</th>
                                    <!-- <th scope="col">BONUS</th>
                                    <th scope="col">SISA</th> -->
                                    <th scope="col">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php  
                            $batas = 5;
                            $halaman = $_GET['halaman'];
                            if(empty($halaman)){
                                $posisi = 0;
                                $halaman = 1;
                            }else{
                                $posisi = ($halaman-1) * $batas;
                            }
                            $queryadmin = "SELECT * FROM data_penjualan ORDER BY tgl_daftar DESC LIMIT $posisi,$batas";
                            $resultadmin = mysqli_query($conn, $queryadmin);
                            while($row = mysqli_fetch_assoc($resultadmin)){
                            ?>
                                <tr>
                                    
                                    <td><?= ucfirst($row['nama_marketing']) ?></td>
                                    <td><?= ucfirst($row['nama_customer']) ?></td>
                                    <td><?= $row['tgl_daftar'] ?></td>
                                    <td>
                                        <?= ucfirst($row['metode_pembayaran']) ?>
                                    </td>
                                    <td>
                                        <?php if($row['status_pembayaran']==2){ ?>
                                            <div class="badge bg-danger" style="width: 7rem;border-radius:3px">
                                                BELUM LUNAS
                                            </div>
                                        <?php }else{ ?>
                                            <div class="badge bg-primary" style="width: 7rem;border-radius:3px">
                                                LUNAS
                                            </div>
                                        <?php } ?>
                                    </td>
                                    
                                    <!-- <td>Rp.<?= number_format($row['bonus_penjualan'],0,",",".") ?></td>
                                    <td>Rp.<?= number_format($row['sisa'],0,",",".") ?></td> -->
                                    <?php if($rowakun['status'] == 2){ ?>
                                    <td style="display: flex;">
                                        <a href="editpelanggan?id=<?= $row['id_customer'] ?>" ><span class="material-icons">edit</span></a>
                                        <a href="#infopelanggan<?= $row['id_customer'] ?>" data-bs-toggle="modal"><span class="material-icons">info</span></a>
                                        <a href="#hapuspelanggan<?= $row['id_customer'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                                    </td>
                                    <?php }else{ ?>
                                    <td>
                                        <a href="#infopelanggan<?= $row['id_customer'] ?>" data-bs-toggle="modal"><span class="material-icons">info</span></a>
                                    </td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <nav aria-label="...">
                        <ul class="pagination">
                            <?php  
                            if($halaman-1 != 0 ){
                                $l = $halaman - 1;
                                echo '<li class="page-item"><a href="data-penjualan?halaman='.$l.'" class="page-link">Previous</a></li>';
                            }else{
                                echo '<li class="page-item disabled">
                                        <span class="page-link">Previous</span>
                                    </li>';
                            }
                            ?>
                            
                            <?php  
                            $pagi = mysqli_query($conn, "SELECT * FROM data_penjualan ORDER BY tgl_daftar");
                            $jumlah = mysqli_num_rows($pagi);
                            $bnykhalaman = ceil($jumlah/$batas);
                            for($j=1; $j<=$bnykhalaman; $j++){
                                if($j != $halaman){
                                    echo '<li class="page-item"><a class="page-link" href="data-penjualan?halaman='.$j.'">'.$j.'</a></li>';
                                }else{
                                    echo ' <li class="page-item active" aria-current="page">
                                                <span class="page-link">'.$j.'</span>
                                            </li>';
                                }
                            }
                            ?>
                            
                            <?php  
                            if($halaman < $bnykhalaman){
                                $g = $halaman + 1;
                                echo '<li class="page-item">
                                    <a class="page-link" href="data-penjualan?halaman='.$g.'">Next</a>
                                </li>';
                            }else{
                                echo '<li class="page-item disabled">
                                        <span class="page-link">Next</span>
                                    </li>';
                            }
                            ?>
                        </ul>
                    </nav>
                <p class="mt-5 footer">
                support by
                <a style="color: black" href="https://galeriide.com">galeriide.com</a>
                </p>
            </div>
        </section>
                                        <?php  
                                        $queryadmin = "SELECT * FROM data_penjualan ORDER BY tgl_daftar DESC";
                                        $resultadmin = mysqli_query($conn, $queryadmin);
                                        while($row = mysqli_fetch_assoc($resultadmin)){
                                        ?>
                                        <div class="modal fade" id="infopelanggan<?= $row['id_customer'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Customer</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Nama Marketing</label>
                                                            <input type="text" readonly value="<?= ucfirst($row['nama_marketing']) ?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Nama Customer</label>
                                                            <input type="text" readonly value="<?= ucfirst($row['nama_customer']) ?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Tanggal Berlangganan</label>
                                                            <input type="text" readonly value="<?= $row['tgl_daftar'] ?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Metode Pembayaran</label>
                                                            <input type="text" readonly value="<?= ucfirst($row['metode_pembayaran']) ?>" class="form-control">
                                                        </div>
                                                        <div id="transaksi" style="display: <?= $none = $row['metode_pembayaran'] =="credit" ? "none" : "block" ?>;">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Terbayar</label>
                                                                    <div class="input-group col-12 mb-3">
                                                                        <span class="input-group-text" >Rp.</span>
                                                                        <input type="text" readonly value="<?= number_format($row['terbayar'],0,",",".") ?>" class="form-control">
                                                                    </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Sisa Pembayaran</label>
                                                                    <div class="input-group col-12 mb-3">
                                                                        <span class="input-group-text" >Rp.</span>
                                                                        <input type="text" readonly value="<?= number_format($row['sisa_terbayar'],0,",",".") ?>" class="form-control">
                                                                    </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Transaksi Terakhir</label>
                                                                <input type="text" readonly value="<?= $row['tgl_bayar'] ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <p style="font-size: 15px;">klik <a data-bs-target="#transaksi<?= $row['id_customer'] ?>" data-bs-toggle="modal" href="">disini untuk melihat riwayat transaksi!</a></p>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Jangka Waktu</label>
                                                            <input type="text" readonly value="<?= $row['jangka_waktu'] ?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Status Pembayaran</label>
                                                            <input type="text" readonly value="<?= $hasil = $row['status_pembayaran'] == 2 ? "BELUM LUNAS" : "LUNAS" ?>" class="form-control">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="" class="form-label">Bonus Penjualan</label>
                                                            <div class="input-group col-12 mb-3">
                                                                <span class="input-group-text" >Rp.</span>
                                                                <input type="text" readonly value="<?=  number_format($row['bonus_penjualan'],0,",",".") ?>" class="form-control">
                                                            </div>
                                                            <p style="font-size: 10px;">*sisa bonus anda Rp. <?= number_format($row['sisa'],0,",",".") ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="transaksi<?= $row['id_customer'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Details Transaksi!</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php  
                                                        $user = $row['nama_customer'];
                                                        $querystory = mysqli_query($conn, "SELECT * FROM story_cicilan WHERE username='$user' ORDER BY tgl_transaksi DESC LIMIT 12");
                                                        while($rowstory = mysqli_fetch_assoc($querystory)){
                                                        ?>
                                                        <p> Tanggal : <?= $rowstory['tgl_transaksi'] ?> </p>
                                                        <p> Nominal : Rp. <?= number_format($rowstory['nominal'],0,",",".") ?> </p>
                                                        <hr>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal Hapus-->
                                        <div class="modal fade" id="hapuspelanggan<?= $row['id_customer'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Menghapus Customer!</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Yakin ingin menghapus Customer Atas Nama <?= ucfirst($row['nama_customer']) ?> ?<br>
                                                    </div>
                                                    <form method="post" action="" class="modal-footer">
                                                        <input type="hidden" name="id" value="<?= $row['id_customer'] ?>">
                                                        <input type="hidden" name="username" value="<?= $row['nama_customer'] ?>">
                                                        <button type="submit" name="hapussales" class="btn btn-danger btn-save">Ya</button>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end modal hapus -->
                                        <?php } ?>

        <!-- js select -->
        <script>
        function showKredit(str){
            if (str == "") {
                document.getElementById("tabel-datakredit").innerHTML = "";
                return;
            }
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("tabel-datakredit").innerHTML = this.responseText;
            }
            xhttp.open("GET", "kredit_input.php?jangka="+str+"&tgl=<?= date("Y-m-d") ?>");
            xhttp.send();
        }
        
    </script>
        <script>
            function showCredit(str){
                document.getElementById("status").disabled = false;
                if(str == "credit"){
                    document.getElementById("transaksi").style.display = "none";
                    document.getElementById("jangka").style.display = "block";
                    document.getElementById("bonus").value = "150000";
                    document.getElementById("sisa").innerHTML = "*Bonus sisa Rp.150000";
                }else{
                    document.getElementById("tabel-datakredit").innerHTML = "";
                    document.getElementById("jangka").style.display = "none";
                    document.getElementById("transaksi").style.display = "block";
                    document.getElementById("bonus").value = "300000";
                    document.getElementById("sisa").innerHTML = "*Bonus sisa Rp.0";
                }
            }
            

        </script>
        <script>
            function showSisa(str){
                var bonus = parseInt(str);
                var sisa = 300000 - bonus;
                document.getElementById("sisa").innerHTML = "*Bonus sisa Rp." + sisa;
            }
        </script>
        <script>
            function bayarSisa(str){
                var bayar = parseInt(str);
                var sisa = 1500000 - bayar;
                document.getElementById("sisabayar").innerHTML = "*sisa pembayaran Rp." + sisa;
            }
        </script>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"
        ></script>
        <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
        <!-- Option 2: Separate Popper and Bootstrap JS -->
                                            
    </body>
</html>
<?php mysqli_close($conn) ?>