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
                    <label for="market" class="form-label">Nama Marketing</label>
                    <?= $inputtt = $row['nama_marketing'] != '' ? '<input type="hidden" name="marketing"  value="'.$row['nama_marketing'].'">' : '' ?>
                    <input type="text"  <?= $readyy = $row['nama_marketing'] != '' ? 'readonly' : 'hidden'  ?> id="" value="<?= ucfirst($row['nama_marketing']) ?>" class="form-control">
                    <?php if($row['nama_marketing'] == ''){ ?>
                        <select name="marketing" required id="marketing" class="form-select">
                            <option value="" selected>Pilih Marketing</option>
                            <?php  
                            $query = mysqli_query($conn, "SELECT * FROM data_marketing");
                            while($row = mysqli_fetch_assoc($query)){
                            ?>
                            <option value="<?= $row['nama'] ?>"><?= ucfirst($row['nama']) ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>
                </div>
                <div class="col-12 mb-3">
                    <label for="" class="form-label">Username</label>
                    <input type="text" name="username" id="" readonly value="<?= ucfirst($row['nama_customer']) ?>" class="form-control">
                </div>
                <div class="col-12 mb-3">
                    <label for="tgl" class="form-label">Tanggal Daftar</label>
                    <input type="text" id="tgl" class="form-control" readonly value="<?= $row['tgl_daftar'] ?>">
                </div>
                <div class="col-12 mb-3">
                    <label for="pembayaran" class="form-label" >Metode Pembayaran</label>
                    <?= $input = $row['metode_pembayaran'] != "" ? '<input type="hidden" name="pembayaran" value="'.$row['metode_pembayaran'].'">' : "" ?>
                    <select  id="pembayaran" <?= $read = $row['metode_pembayaran'] != "" ? "disabled" : "name='pembayaran'" ?>  class="form-select" onchange="showCredit(this.value)">
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
                <div class="col-12 mb-3" id="jangka" style="display: <?=  $hidden = $row['metode_pembayaran'] == "cash" ? "none" : "block"; ?>;">
                    <label for="jangka" class="form-label">Jangka Waktu</label>
                    <?= $input2 = $row['jangka_waktu'] != "" ? '<input type="hidden" name="jangka" value="'.$row['jangka_waktu'].'">' : "" ?>
                    <select <?= $read = $row['jangka_waktu'] != "" ? "disabled" : "name='jangka'" ?> id="jangka" class="form-select" onchange="showKredit(this.value)">
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
                <div id="tabel-datakredit" class="col-12 col-sm-4">
                    
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
                            echo '<option value="'.$value.'" '.$selected.'>'.$status[$k].'</option>';
                            ++$value;
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12 form-check " id="tf">
                    <input class="form-check-input" name="tf"  type="checkbox"  onclick="showTr()" id="tfr">
                    <label class="form-check-label" for="tfr" id="lab" style="font-size: 15px;">
                        Jika terjadi transaksi Ceklis disini.
                    </label>
                </div>
                <div id="transaksi" style="display: none;">
                    <div class="col-12 mb-3">
                    <label for="" class="form-label">Nominal Pembayaran</label>
                        <div class="input-group col-12 mb-3">
                            <span class="input-group-text" >Rp.</span>
                            <input type="number" name="terbayar" id="terbayar" value="0" class="form-control" onkeyup="bayarSisa(this.value)">
                        </div>
                        
                    </div>
                    <div class="col-12 mb-3">
                        <label for="" class="form-label">Transaksi Terakhir</label>
                        <input type="date" name="tgl_bayar" class="form-control" value="<?= $row['tgl_bayar'] ?>">
                    </div>
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
        $(document).ready(function(){
            if ("<?= $row['metode_pembayaran'] ?>" == "cash") {
                document.getElementById("tabel-datakredit").innerHTML = "";
                document.getElementById("tf").style.display = "block";
                document.getElementById("transaksi").style.display = "block";
                document.getElementById("tfr").checked = true;
                document.getElementById("lab").style.display = "block";
                return;
            }else if("<?= $row['metode_pembayaran'] ?>" == "credit"){
                document.getElementById("tf").style.display = "none";
                document.getElementById("transaksi").style.display = "none";
                document.getElementById("tfr").checked = false;
                document.getElementById("lab").style.display = "none";
            }
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function() {
                document.getElementById("tabel-datakredit").innerHTML = this.responseText;
            }
            xhttp.open("GET", "kredit.php?jangka=<?= $row['jangka_waktu'] ?>&tgl=<?= $row['tgl_daftar'] ?>&username=<?= $row['nama_customer'] ?>");
            xhttp.send();
        });
    </script>
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
            xhttp.open("GET", "kredit.php?jangka="+str+"&tgl=<?= $row['tgl_daftar'] ?>&username=<?= $row['nama_customer'] ?>");
            xhttp.send();
        }
        
    </script>
    <script>
            function showCredit(str){
                if(str == "credit"){
                    document.getElementById("jangka").style.display = "block";
                    document.getElementById("bonus").value = "150000";
                    document.getElementById("tf").style.display = "none";
                    document.getElementById("transaksi").style.display = "none";
                    document.getElementById("lab").style.display = "none";
                    document.getElementById("tfr").checked = false;
                    document.getElementById("sisa").innerHTML = "*Bonus sisa Rp.150000";
                }else{
                    document.getElementById("tabel-datakredit").innerHTML = "";
                    document.getElementById("tf").style.display = "block";
                    document.getElementById("lab").style.display = "block";
                    document.getElementById("jangka").style.display = "none";
                    document.getElementById("bonus").value = "300000";
                    document.getElementById("sisa").innerHTML = "*Bonus sisa Rp.0";
                }
            }
            

        </script>
        <script>
            function showTr() {
                var checkBox = document.getElementById("tfr");
                var dvPassport = document.getElementById("transaksi");
                if(checkBox.checked == true){
                    dvPassport.style.display = "block";
                }else{
                    dvPassport.style.display = "none";
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