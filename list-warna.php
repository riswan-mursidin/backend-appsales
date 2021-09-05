<?php include "header.php"; 
if($_SESSION['login'] != "true"){
  header('Location: index');
}

$id = $_GET['page'];

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
          <li class="breadcrumb-item"><a href="edit-merek">Merek</a></li>
          <li class="breadcrumb-item active"><a href="#">Warna</a></li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
          <h5>EDIT DATA WARNA</h5>

          <div class="col-12">
            <table
              class="table table-striped table-hover"
              style="font-size: large"
            >
              <thead>
                <tr>
                  <th scope="col">GAMBAR</th>
                  <th scope="col">WARNA</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
              <?php  
              $_SESSION['merek_id'] = $id;
              $querywarna = "SELECT * FROM warna_merek WHERE id_merek='$id'";
              $resultwarna = mysqli_query($conn, $querywarna);
              while($row = mysqli_fetch_assoc($resultwarna)){
              ?>
                <tr>
                  <td>
                    <img
                      src="<?php echo $rowakun['domain']."/".$row['foto_warna'] ?>"
                      width="100px"
                      alt="merek"
                />
                  </td>
                  <td><?php echo $row['ket_warna'] ?></td>
                  <td>
                    <a href="data-warna?page=<?= $row['id_warna'] ?>"><span class="material-icons">edit</span></a>
                    <a href="#hapuswarna<?= $row['id_warna'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                    <!-- Modal -->
                    <div class="modal fade" id="hapuswarna<?= $row['id_warna'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Warna!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus warna ini dari daftar?<br>
                          </div>
                          <form method="post" action="" class="modal-footer">
                            <input type="hidden" name="idwarna" value="<?= $row['id_warna'] ?>"">
                            <button type="submit" name="hapuswarna" class="btn btn-danger btn-save">Ya</button>
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
        <form class="row" action="data-warna" method="post">
            <div
              class="col-4 btn-group"
              role="group"
              aria-label="Basic mixed styles example"
            >
              <input type="hidden" name="idmerek" value="<?= $id ?>">
              <button type="submit" name="tambahwarna" class="btn btn-danger btn-save">TAMBAH WARNA</button>
            </div>
          </form>

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