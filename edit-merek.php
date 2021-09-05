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
          <li class="breadcrumb-item"><a href="list-produk">Produk</a></li>
          <li class="breadcrumb-item active"><a href="#">Merek</a></li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
          <h5>EDIT DATA MEREK</h5>

          <div class="col-12">
            <table
              class="table table-striped table-hover"
              style="font-size: small"
            >
              <thead>
                <tr>
                  <th scope="col">GAMBAR</th>
                  <th scope="col">MEREK</th>
                  <th scope="col">WARNA</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
              <?php  
              
              $querymerek = "SELECT * FROM merek_mobil WHERE id_admin = '$_SESSION[user]'";
              $resultmerek = mysqli_query($conn, $querymerek);
              while($row = mysqli_fetch_assoc($resultmerek)){
              ?>
                <tr>
                  <td>
                    <a href="list-highlight?page=<?= $row['id_merek'] ?>">
                      <img
                        src="<?php echo $rowakun['domain']."/".$row['foto_merek'] ?>"
                        width="100px"
                        alt="merek" />
                    </a>
                  </td>
                  <td><a href="list-type?page=<?= $row['id_merek'] ?>"><?php echo $row['nama_merek'] ?></a></td>
                  <td class="td-warna"><a href="list-warna?page=<?= $row['id_merek'] ?>"><?= showJumlahwarna($row['id_merek']) ?><span class="material-icons">tune</span></a></td>
                  <td>
                    <a href="data-merek?page=<?= $row['id_merek'] ?>"><span class="material-icons">edit</span></a>
                    <a href="#hapusmerek<?= $row['id_merek'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                    <!-- Modal -->
                    <div class="modal fade" id="hapusmerek<?= $row['id_merek'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Merek!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus <?php echo $row['nama_merek'] ?> dari daftar merek?<br>
                            <p style="font-size: 10px;">data type dan warna yang termasuk dari merek ini akan terhapus juga.</p>
                          </div>
                          <form method="post" action="" class="modal-footer">
                            <input type="hidden" name="idmerek" value="<?= $row['id_merek'] ?>"">
                            <button type="submit" name="hapusmerek" class="btn btn-danger btn-save">Ya</button>
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
            <a href="data-merek"
              ><button type="button"  class="btn btn-danger btn-save">
                TAMBAH MEREK 
              </button></a>
          </div>
        </div>
        <div class="container keterangan-table mt-2">
         <div class="row">
         <h6> Silahkan klik salah satu kolom table untuk mengedit: </h6>
         <p> - Kolom Gambar untuk mengedit atau menambahkan Fitur Gambar Hightlight </p>                    
         <p> - Kolom Merek untuk mengedit Harga, Menambahkan dan Menghapus Type Mobil </p>         
         <p> - Kolom Warna Menampilkan jumlah dan Tombol edit warna setiap Merek </p>
         <p> - ACTION Edit untuk megubah Gambar Utama Merek dan Deskripsi Merek <br>
         - ACTION Delete untuk menghapus semua data Merek mobil yang dipilih </p>
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