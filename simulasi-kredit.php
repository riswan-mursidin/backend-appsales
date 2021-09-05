<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}

function showType($id){
    include "koneksi.php";
    $querytype = mysqli_query($conn, "SELECT id_type,harga_type,nama_type FROM type_mobil WHERE id_merek='$id'");
    while($rowtype = mysqli_fetch_assoc($querytype)){
        echo '<option value="'.$rowtype['harga_type'].'">'.$rowtype['nama_type'].'</option>';
    }
}
?>
    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                Simulasi Kredit
                </li>
            </ol>
        </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <!-- Akhir Navbar -->
        <section id="data-listharga">
        <form name="form" class="container">
            <div class="row">
                <h5>Simulasi Kredit</h5>
                <hr />
                <div class="col-12 col-md-12 mb-3">
                    <select class="form-select" name="harga">
                        <option selected>Pilih Produk</option>
                        <?php  
                        $querymerek = mysqli_query($conn, "SELECT id_merek,nama_merek FROM merek_mobil WHERE id_admin='$_SESSION[user]'");
                        while($rowmerek = mysqli_fetch_assoc($querymerek)){
                        ?>
                        <optgroup label="<?= $rowmerek['nama_merek'] ?>">
                            <?= showType($rowmerek['id_merek']) ?>
                        </optgroup>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-12 col-md-12">
                    <div class="input-group mb-3">
                        <span class="input-group-text" >Rp. </span>
                        <input type="number" step="0.01" class="form-control" placeholder="Uang Muka (dalam Rupiah)" name="muka">
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" placeholder="Jangka Waktu Pembayaran" name="jangka">
                        <span class="input-group-text" >Tahun</span>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="input-group mb-3">
                        <input type="number" step="0.01" class="form-control" placeholder="Suku Bunga Per tahun" name="bunga">
                        <span class="input-group-text" >%</span>
                    </div>
                </div>
            </div>
            <div id="myDIV">
                <h6>Hasil</h6>
                <hr>
                <div class="col-12 col-md-12 mb-3">
                    <label for="">Harga Mobil Dipotong Dp</label>
                    <input class="form-control" type="text" name="pinjam" placeholder="Rp. 0.00" aria-label="Disabled input example" disabled>
                </div>
                <div class="col-12 col-md-12 mb-3">
                    <label for="">Uang muka yang harus dibayar</label>
                    <input class="form-control" type="text" name="uangmukatotal" placeholder="Rp. 0.00" aria-label="Disabled input example" disabled>
                </div>
                <div class="col-12 col-md-12 mb-3">
                    <label for="">Angsuran Perbulan</label>
                    <input class="form-control" type="text" name="angsuran" placeholder="Rp. 0.00" aria-label="Disabled input example" disabled>
                </div>
            </div>
            <div class="row">
                <div
                    class="col-6 btn-group"
                    role="group"
                    aria-label="Basic mixed styles example"
                >
                    <input type="button" onclick="hasilHitung()" class="btn btn-danger btn-save" value="HITUNG ANGSURAN">
                </div>
                <div
                    class="col-6 btn-group"
                    role="group"
                    aria-label="Basic mixed styles example"
                >
                    <button type="reset" name="aksigaleri2" class="btn btn-danger btn-save">RESET</button>
                </div>
            </div>
        </form>
        <p class="mt-5 footer text-center">
            support by
            <a style="color: black" href="https://galeriide.com">galeriide.com</a>
        </p>
        <div class="mt-3 mb-5">&nbsp;</div>
        </section>

        <script>
        function formatMoney(n) {
            return "Rp. " + (Math.round(n * 100) / 100).toLocaleString();
        }
        function hasilHitung(){
            // ambil nilai input
            uangmuka = parseInt(form.muka.value);
            pinjam = parseInt(form.harga.value);
            waktu = parseInt(form.jangka.value);
            persen = parseFloat(form.bunga.value);
            // perhitungan
            angsuran = pinjam - uangmuka;
            perwaktu = angsuran / (waktu * 12);
            bunga = (angsuran * (persen / 100)) / 12;
            n = perwaktu + bunga;
            j = uangmuka + n;
            // hasil
            form.pinjam.value = formatMoney(angsuran);
            form.uangmukatotal.value = formatMoney(j);
            form.angsuran.value = formatMoney(n);
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