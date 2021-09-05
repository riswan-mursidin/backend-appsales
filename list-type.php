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
            Type
          </li>
        </ol>
      </nav>
    </div>
    <!-- Akhir Breadcrumb -->
    <section id="data-listharga">
      <div class="container">
        <div class="row">
          <h5>LIST DATA <?php echo strtoupper($rowmerek['nama_merek']) ?></h5>
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
              style="font-size: small"
            >
              <thead>
                <tr>
                  <th scope="col">TYPE</th>
                  <th scope="col">HARGA RP.</th>
                  <th scope="col">ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php  
                $_SESSION['merek_id'] = $id_merek;
                $querytype = "SELECT * FROM type_mobil WHERE id_admin='$_SESSION[user]' AND id_merek='$id_merek'";
                $resulttype = mysqli_query($conn, $querytype);
                while($rowtype = mysqli_fetch_assoc($resulttype)){
                ?>
                <tr>
                  <td><?= $rowtype['nama_type'] ?></td>
                  <td>Rp.<?= number_format($rowtype['harga_type'],0,",",".") ?></td>
                  <td>
                    <a href="data-type?page=<?= $rowtype['id_type'] ?>"><span class="material-icons">edit</span></a>
                    <a href="#hapustype<?= $rowtype['id_type'] ?>" data-bs-toggle="modal"><span class="material-icons">delete</span></a>
                    <!-- Modal -->
                    <div class="modal fade" id="hapustype<?= $rowtype['id_type'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Type!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus <?php echo $rowtype['nama_type'] ?> dari daftar Type?<br>
                          </div>
                          <form method="post" action="" class="modal-footer">
                            <input type="hidden" name="idtype" value="<?= $rowtype['id_type'] ?>"">
                            <button type="submit" name="hapustype" class="btn btn-danger btn-save">Ya</button>
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
          <form class="row" action="data-type" method="post">
            <div
              class="col-6 btn-group"
              role="group"
              aria-label="Basic mixed styles example"
            >
              <input type="hidden" name="idmerek" value="<?= $id_merek ?>">
              <button type="submit" name="tambahproduk" class="btn btn-danger btn-save">TAMBAH TYPE</button>
            </div>
          </form>
          
          <!--Spesifikasi-->
    <div class="accordion mt-5" id="accordionExample">
      <div class="accordion-item">
          <h5 class="accordion-header" id="headingOne">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
           Tambahkan Spesifikasi
          </button>
          </h5>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
          <div class="accordion-body">
            <form action="" method="post" autocomplete="off">
            <div class="tambah_dimensi">
                <hr>
              <label for="" class="form-label mt3"> <strong> Spesifikasi Dimensi </strong> </label>
              <div class="row">
                <?php  
                $querydimensi = mysqli_query($conn, "SELECT * FROM detail WHERE id_merek='$id_merek' AND id_kategori='1' AND id_admin='$_SESSION[user]'");
                if(mysqli_num_rows($querydimensi) > 0){
                  while($rowdimensi = mysqli_fetch_assoc($querydimensi)){
                ?>
                <div class="row">
                  <input type="hidden" name="iddimensi[]" value="<?= $rowdimensi['id_detail'] ?>">
                  <div class="form-floating col-12 col-sm-4 mb-3">
                      <input type="text" class="form-control" id="fielddimensi" name="fielddimensi[]" placeholder="name@example.com" value="<?= $rowdimensi['nama_field'] ?>">
                      <label for="fielddimensi" class="ms-2">Field</label>
                      <p style="font-size: 10px;">Contoh: Ukuran</p>
                  </div>
                  <div class="form-floating col-12 col-sm-4 ">
                    <input type="text" class="form-control" id="valuedimensi" name="valuedimensi[]" placeholder="Password" value="<?= $rowdimensi['value_field'] ?>">
                    <label for="valuedimensi" class="ms-2">Value</label>
                    <p style="font-size: 10px;">Contoh: 20cm</p>
                  </div>
                  <div class="col-6 col-sm-2 mb-5">
                    <a href="#deletespek<?= $rowdimensi['id_detail'] ?>" class="btn btn-danger" data-bs-toggle="modal">x DELETE</a>
                    <!-- Modal -->
                    <div class="modal fade" id="deletespek<?= $rowdimensi['id_detail'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Type!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus Spesifikasi dari daftar ?<br>
                          </div>
                          <div class="modal-footer">
                            <a href="aksi.php?deletespek=<?= $rowdimensi['id_detail'] ?>" class="btn btn-danger btn-save">Ya</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  <?php }} ?>
                <div class="row">
                  <input type="hidden" name="iddimensi[]">
                  <div class="form-floating col-12 col-sm-4 mb-3">
                      <input type="text" class="form-control" id="fielddimensi" name="fielddimensi[]" placeholder="name@example.com">
                      <label for="fielddimensi" class="ms-2">Field</label>
                      <p style="font-size: 10px;">Contoh: Ukuran</p>
                  </div>
                  <div class="form-floating col-12 col-sm-4 ">
                    <input type="text" class="form-control" id="valuedimensi" name="valuedimensi[]" placeholder="Password">
                    <label for="valuedimensi" class="ms-2">Value</label>
                    <p style="font-size: 10px;">Contoh: 20cm</p>
                  </div>
                  <div class="col-6 col-sm-2 mb-5">
                      <button class="btn btn-primary add_dimensi_button">+ ADD NEW</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tambah_mesin">
              <label for="" class="form-label"> <strong> Spesifikasi Mesin </strong> </label>
              <hr>
              <div class="row">
              <?php  
                $querymesin = mysqli_query($conn, "SELECT * FROM detail WHERE id_merek='$id_merek' AND id_kategori='2' AND id_admin='$_SESSION[user]'");
                if(mysqli_num_rows($querymesin) > 0){
                  while($rowmesin = mysqli_fetch_assoc($querymesin)){
                ?>
                <div class="row">
                  <input type="hidden" name="idmesin[]" value="<?= $rowmesin['id_detail'] ?>">
                  <div class="form-floating col-12 col-sm-4 mb-3">
                      <input type="text" class="form-control" id="fieldmesin" name="fieldmesin[]" placeholder="name@example.com" value="<?= $rowmesin['nama_field'] ?>">
                    <label for="fieldmesin" class="ms-2">Field</label>
                    <p style="font-size: 10px;">Contoh: Ukuran</p>
                  </div>
                  <div class="form-floating col-12 col-sm-4 ">
                    <input type="text" class="form-control" id="valuemesin" name="valuemesin[]" placeholder="Password" value="<?= $rowmesin['value_field'] ?>">
                    <label for="valuemesin" class="ms-2">Value</label>
                    <p style="font-size: 10px;">Contoh: 20cm</p>
                  </div>
                  <div class="col-6 col-sm-2 mb-5">
                  <a href="#deletespek<?= $rowmesin['id_detail'] ?>" class="btn btn-danger" data-bs-toggle="modal">x DELETE</a>
                    <!-- Modal -->
                    <div class="modal fade" id="deletespek<?= $rowmesin['id_detail'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Type!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus Spesifikasi dari daftar ?<br>
                          </div>
                          <div class="modal-footer">
                            <a href="aksi.php?deletespek=<?= $rowmesin['id_detail'] ?>" class="btn btn-danger btn-save">Ya</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }} ?>
                <div class="row">
                  <input type="hidden" name="idmesin[]">
                  <div class="form-floating col-12 col-sm-4 mb-3">
                      <input type="text" class="form-control" id="fieldmesin" name="fieldmesin[]" placeholder="name@example.com">
                    <label for="fieldmesin" class="ms-2">Field</label>
                    <p style="font-size: 10px;">Contoh: Ukuran</p>
                  </div>
                  <div class="form-floating col-12 col-sm-4 ">
                    <input type="text" class="form-control" id="valuemesin" name="valuemesin[]" placeholder="Password">
                    <label for="valuemesin" class="ms-2">Value</label>
                    <p style="font-size: 10px;">Contoh: 20cm</p>
                  </div>
                  <div class="col-6 col-sm-2 mb-5">
                      <button class="btn btn-primary add_mesin_button">+ ADD NEW</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="tambah_kaki">
                 <hr>
              <label for="" class="form-label"> <strong> Spesifikasi Kaki-kaki </strong> </label>
              <div class="row">
              <?php  
                $querykaki = mysqli_query($conn, "SELECT * FROM detail WHERE id_merek='$id_merek' AND id_kategori='3' AND id_admin='$_SESSION[user]'");
                if(mysqli_num_rows($querykaki) > 0){
                  while($rowkaki = mysqli_fetch_assoc($querykaki)){
                ?>
                <div class="row">
                  <input type="hidden" name="idkaki[]" value="<?= $rowkaki['id_detail'] ?>">
                  <div class="form-floating col-12 col-sm-4 mb-3">
                      <input type="text" class="form-control" id="fieldkaki" name="fieldkaki[]" placeholder="name@example.com" value="<?= $rowkaki['nama_field'] ?>">
                    <label for="fieldkaki" class="ms-2">Field</label>
                    <p style="font-size: 10px;">Contoh: Ukuran</p>
                  </div>
                  <div class="form-floating col-12 col-sm-4 ">
                    <input type="text" class="form-control" id="valuekaki" name="valuekaki[]" placeholder="Password" value="<?= $rowkaki['value_field'] ?>">
                    <label for="valuekaki" class="ms-2">Value</label>
                    <p style="font-size: 10px;">Contoh: 20cm</p>
                  </div>
                  <div class="col-6 col-sm-2 mb-5">
                  <a href="#deletespek<?= $rowkaki['id_detail'] ?>" class="btn btn-danger" data-bs-toggle="modal">x DELETE</a>
                    <!-- Modal -->
                    <div class="modal fade" id="deletespek<?= $rowkaki['id_detail'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Type!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus Spesifikasi dari daftar ?<br>
                          </div>
                          <div class="modal-footer">
                            <a href="aksi.php?deletespek=<?= $rowkaki['id_detail'] ?>" class="btn btn-danger btn-save">Ya</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }} ?>
                  <div class="row">
                    <input type="hidden" name="idkaki[]">
                    <div class="form-floating col-12 col-sm-4 mb-3">
                        <input type="text" class="form-control" id="fieldkaki" name="fieldkaki[]" placeholder="name@example.com">
                      <label for="fieldkaki" class="ms-2">Field</label>
                      <p style="font-size: 10px;">Contoh: Ukuran</p>
                    </div>
                    <div class="form-floating col-12 col-sm-4 ">
                      <input type="text" class="form-control" id="valuekaki" name="valuekaki[]" placeholder="Password">
                      <label for="valuekaki" class="ms-2">Value</label>
                      <p style="font-size: 10px;">Contoh: 20cm</p>
                    </div>
                  <div class="col-6 col-sm-2 mb-5">
                      <button class="btn btn-primary add_kaki_button">+ ADD NEW</button>
                  </div>
                  </div>
              </div>
            </div>
            <div class="tambah_rem">
            <hr>
              <label for="" class="form-label"> <strong> Spesifikasi Pengereman </strong></label>
              <div class="row">
              <?php  
                $queryrem = mysqli_query($conn, "SELECT * FROM detail WHERE id_merek='$id_merek' AND id_kategori='4' AND id_admin='$_SESSION[user]'");
                if(mysqli_num_rows($queryrem) > 0){
                  while($rowrem = mysqli_fetch_assoc($queryrem)){
                ?>
                <div class="row">
                  <input type="hidden" name="idrem[]" value="<?= $rowrem['id_detail'] ?>">
                  <div class="form-floating col-12 col-sm-4 mb-3">
                      <input type="text" class="form-control" id="fieldrem" name="fieldrem[]" placeholder="name@example.com" value="<?= $rowrem['nama_field'] ?>">
                    <label for="fieldrem" class="ms-2">Field</label>
                    <p style="font-size: 10px;">Contoh: Ukuran</p>
                  </div>
                  <div class="form-floating col-12 col-sm-4 ">
                    <input type="text" class="form-control" id="valuerem" name="valuerem[]" placeholder="Password" value="<?= $rowrem['value_field'] ?>">
                    <label for="valuerem" class="ms-2">Value</label>
                    <p style="font-size: 10px;">Contoh: 20cm</p>
                  </div>
                  <div class="col-6 col-sm-2 mb-5">
                  <a href="#deletespek<?= $rowrem['id_detail'] ?>" class="btn btn-danger" data-bs-toggle="modal">x DELETE</a>
                    <!-- Modal -->
                    <div class="modal fade" id="deletespek<?= $rowrem['id_detail'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Menghapus Type!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Yakin ingin menghapus Spesifikasi dari daftar ?<br>
                          </div>
                          <div class="modal-footer">
                            <a href="aksi.php?deletespek=<?= $rowrem['id_detail'] ?>" class="btn btn-danger btn-save">Ya</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }} ?>
                <div class="row">
                  <input type="hidden" name="idrem[]">
                  <div class="form-floating col-12 col-sm-4 mb-3">
                      <input type="text" class="form-control" id="fieldrem" name="fieldrem[]" placeholder="name@example.com">
                    <label for="fieldrem" class="ms-2">Field</label>
                    <p style="font-size: 10px;">Contoh: Ukuran</p>
                  </div>
                  <div class="form-floating col-12 col-sm-4 ">
                    <input type="text" class="form-control" id="valuerem" name="valuerem[]" placeholder="Password">
                    <label for="valuerem" class="ms-2">Value</label>
                    <p style="font-size: 10px;">Contoh: 20cm</p>
                  </div>
                  <div class="col-6 col-sm-2 mb-5">
                      <button class="btn btn-primary add_rem_button">+ ADD NEW</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 col-sm-8">
                <button type="submit" name="aksispesifikasi" class="btn btn-danger btn-save">SIMPAN</button>
              </div>
            </div>
          </form>
        </div>
            </div>
       </div>
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

    <script>
      $(document).ready(function() {
        // dimensi
        var max_fields_dimensi      = 15; //maximum input boxes allowed
        var wrapper_dimensi   		= $(".tambah_dimensi"); //Fields wrapper
        var add_button_dimensi      = $(".add_dimensi_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button_dimensi).click(function(e){ //on add input button click
          e.preventDefault();
          if(x < max_fields_dimensi){ //max input box allowed
            x++; //text box increment
            $(wrapper_dimensi).append('<div class="row hapus">\
                <input type="hidden" name="iddimensi[]">\
                <div class="form-floating  col-12 col-sm-4 mb-3">\
                  <input type="text" class="form-control" id="fielddimensi" name="fielddimensi[]" placeholder="name@example.com">\
                  <label for="fielddimensi" class="ms-2">Field</label>\
                  <p style="font-size: 10px;">Contoh: Ukuran</p>\
                </div>\
                <div class="form-floating col-12 col-sm-4 ">\
                  <input type="text" class="form-control" id="valuedimensi" name="valuedimensi[]" placeholder="Password">\
                  <label for="valuedimensi" class="ms-2">Value</label>\
                  <p style="font-size: 10px;">Contoh: 20cm</p>\
                </div>\
                <div class="col-6 col-sm-2 mb-5"><button type="button" class="remove_dimensi_field btn btn-warning">X REMOVE</button>\<\div>\
              </div>'); //add input box
          }
        });
        
        $("body").on("click",".remove_dimensi_field", function(e){ //user click on remove text
          e.preventDefault(); $(this).closest('.hapus').remove(); x--;
        })

        // mesin
        var max_fields_mesin      = 15; //maximum input boxes allowed
        var wrapper_mesin   		= $(".tambah_mesin"); //Fields wrapper
        var add_button_mesin      = $(".add_mesin_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button_mesin).click(function(e){ //on add input button click
          e.preventDefault();
          if(x < max_fields_mesin){ //max input box allowed
            x++; //text box increment
            $(wrapper_mesin).append('<div class="row hapus">\
                <input type="hidden" name="idmesin[]">\
                <div class="form-floating  col-12 col-sm-4 mb-3">\
                  <input type="text" class="form-control" id="fieldmesin" name="fieldmesin[]" placeholder="name@example.com">\
                  <label for="fieldmesin" class="ms-2">Field</label>\
                  <p style="font-size: 10px;">Contoh: Ukuran</p>\
                </div>\
                <div class="form-floating col-12 col-sm-4 ">\
                  <input type="text" class="form-control" id="valuemesin" name="valuemesin[]" placeholder="Password">\
                  <label for="valuemesin" class="ms-2">Value</label>\
                  <p style="font-size: 10px;">Contoh: 20cm</p>\
                </div>\
                <div class="col-6 col-sm-2 mb-5"><button type="button" class="remove_mesin_field btn btn-warning">X REMOVE</button>\<\div>\
              </div>'); //add input box
          }
        });
        
        $("body").on("click",".remove_mesin_field", function(e){ //user click on remove text
          e.preventDefault(); $(this).closest('.hapus').remove(); x--;
        })

        // kaki
        var max_fields_kaki      = 15; //maximum input boxes allowed
        var wrapper_kaki   		= $(".tambah_kaki"); //Fields wrapper
        var add_button_kaki      = $(".add_kaki_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button_kaki).click(function(e){ //on add input button click
          e.preventDefault();
          if(x < max_fields_kaki){ //max input box allowed
            x++; //text box increment
            $(wrapper_kaki).append('<div class="row hapus">\
                <input type="hidden" name="idkaki[]">\
                <div class="form-floating  col-12 col-sm-4 mb-3">\
                  <input type="text" class="form-control" id="fieldkaki" name="fieldkaki[]" placeholder="name@example.com">\
                  <label for="fieldkaki" class="ms-2">Field</label>\
                  <p style="font-size: 10px;">Contoh: Ukuran</p>\
                </div>\
                <div class="form-floating col-12 col-sm-4 ">\
                  <input type="text" class="form-control" id="valuekaki" name="valuekaki[]" placeholder="Password">\
                  <label for="valuekaki" class="ms-2">Value</label>\
                  <p style="font-size: 10px;">Contoh: 20cm</p>\
                </div>\
                <div class="col-6 col-sm-2 mb-5"><button type="button" class="remove_kaki_field btn btn-warning">X REMOVE</button>\<\div>\
              </div>'); //add input box
          }
        });
        
        $("body").on("click",".remove_kaki_field", function(e){ //user click on remove text
          e.preventDefault(); $(this).closest('.hapus').remove(); x--;
        })

        // rem
        var max_fields_rem      = 15; //maximum input boxes allowed
        var wrapper_rem   		= $(".tambah_rem"); //Fields wrapper
        var add_button_rem      = $(".add_rem_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button_rem).click(function(e){ //on add input button click
          e.preventDefault();
          if(x < max_fields_rem){ //max input box allowed
            x++; //text box increment
            $(wrapper_rem).append('<div class="row hapus">\
                <input type="hidden" name="idrem[]">\
                <div class="form-floating  col-12 col-sm-4 mb-3">\
                  <input type="text" class="form-control" id="fieldrem" name="fieldrem[]" placeholder="name@example.com">\
                  <label for="fieldrem" class="ms-2">Field</label>\
                  <p style="font-size: 10px;">Contoh: Ukuran</p>\
                </div>\
                <div class="form-floating col-12 col-sm-4 ">\
                  <input type="text" class="form-control" id="valuerem" name="valuerem[]" placeholder="Password">\
                  <label for="valuerem" class="ms-2">Value</label>\
                  <p style="font-size: 10px;">Contoh: 20cm</p>\
                </div>\
                <div class="col-6 col-sm-2 mb-5"><button type="button" class="remove_rem_field btn btn-warning">X REMOVE</button>\<\div>\
              </div>'); //add input box
          }
        });
        
        $("body").on("click",".remove_rem_field", function(e){ //user click on remove text
          e.preventDefault(); $(this).closest('.hapus').remove(); x--;
        })

      });
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
  </body>
</html>
<?php mysqli_close($conn) ?>