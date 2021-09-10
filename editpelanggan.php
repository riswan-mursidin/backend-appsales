<?php 
$id = $_GET['id'];
include "header.php"; 
$queryadmin = "SELECT * FROM data_penjualan WHERE id_customer='$id'";
$resultadmin = mysqli_query($conn, $queryadmin);
if(mysqli_num_rows($resultadmin)==0){
    echo "<script type='text/javascript'>document.location.href = 'data-penjualan';</script>";
}
$row = mysqli_fetch_assoc($resultadmin);
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
if($rowakun['status'] != 2){
    echo "<script type='text/javascript'>document.location.href = 'home';</script>";
}
?>
    <!-- Akhir Navbar -->
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item"><a href="data-penjualan">Data Penjualan</a></li>
                <li class="breadcrumb-item active"><a href="#">Edit Data Penjualan</a></li>
            </ol>
        </nav>
    </div>
    <section id="data-listharga">
        <div class="container">
            <form method="post" action="" class="row">
                <div class="col-12 mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="" id="" readonly value="<?= ucfirst($row['nama_customer']) ?>" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="tgl" class="form-label">Tanggal Daftar</label>
                    <input type="text" id="tgl" class="form-control" readonly value="<?= $row['tgl_daftar'] ?>">
                </div>
                <div class="col-12 mb-3">
                    <label for="pembayaran" class="form-label" >Metode Pembayaran</label>
                    <select name="pembayaran" id="pembayaran" class="form-select" onchange="showCredit(this.value)" required>
                        <option value="" hidden>PILIH METODE</option>
                        <?php  
                        $metode = array("cash","credit");
                        for($i=0;$i<count($metode);$i++){
                            $selected = $metode[$i] == $row['metode_pembayaran'] ? "selected='selected'" : "";
                            echo '<option value="'.$metode[$i].'"'.$selected.'>'.ucfirst($metode[$i]).'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="status" class="form-label" >Status Pembayaran</label>
                    <select name="status" id="status" class="form-select" required >
                        <option value="" hidden>PILIH STATUS</option>
                        <?php  

                        $status = array("LUNAS","BELUM LUNAS");
                        $value = 1; 
                        for($k=0;$k<count($status);$k++){
                            $selected = $value == $row['status_pembayaran'] ? "selected='selected'" : "";
                            $idsel = $value == 2 ? "id='nas'" : "";
                            $hidden = $row['metode_pembayaran'] == "cash" && $value == 2 ? "hidden" : "";
                            echo '<option value="'.$value.'" '.$selected.' '.$idsel.' '.$hidden.'>'.$status[$k].'</option>';
                            ++$value;
                        }
                        ?>
                    </select>
                </div>
                
                <div class="col-12 mb-3" id="jangka" style="display: <?=  $hidden = $row['metode_pembayaran'] == "cash" ? "none" : "block"; ?>;">
                    <label for="jangka" class="form-label">Jangka Waktu</label>
                    <select name="jangka" id="jangka" class="form-select">
                        <option value="" selected="selected">PILIH JANGKA WAKTU</option>
                        <?php  
                        $jangka = array("3 Bulan","6 Bulan","12 Bulan");
                        for($r=0;$r<count($jangka);$r++){
                            $selected = $jangka[$r] === $row['jangka_waktu'] ? "selected='selected'" : "";
                            echo '<option value="'.$jangka[$r].'"'.$selected.'>'.$jangka[$r].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="bonus" class="form-label">Bonus</label>
                    <div class="input-group col-12 mb-3">
                        <span class="input-group-text" >Rp.</span>
                        <input type="text" placeholder="Bonus Penjual Website" value="<?= $row['bonus_penjualan'] ?>" name="bonus" required id="bonus" onkeyup="showSisa(this.value)" class="form-control">
                    </div>
                    <p style="font-size: 10px;" id="sisa">*Bonus sisa Rp.<?= $row['sisa'] ?></p>
                </div>
                <div class="col-12 col-sm-4 mb-3">
                    <button class="btn btn-primary" name="aksieditsal" type="submit">Simpan</button>
                </div>
            </form>
            <p class="mt-5 footer">
            support by
            <a style="color: black" href="https://galeriide.com">galeriide.com</a>
            </p>
        </div>
    </section>
    <!-- js select -->
    <script>
            function showCredit(str){
                if(str == "credit"){
                    document.getElementById("jangka").style.display = "block";
                    document.getElementById("bonus").value = "150000";
                    document.getElementById("nas").hidden = false;
                    document.getElementById("sisa").innerHTML = "*Bonus sisa Rp.150000";
                }else{
                    document.getElementById("nas").hidden = true;
                    document.getElementById("jangka").style.display = "none";
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