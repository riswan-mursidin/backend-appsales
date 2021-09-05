<?php  
    include "koneksi.php";
    $i = 1;
    $get = $_GET['q'];
    $sql = mysqli_query($conn, "SELECT id_costumer,nama_costumer,no_costumer,kota_costumer FROM costumer WHERE kategori='1' AND id_admin = '$_SESSION[user]' OR nama_costumer REGEXP '^$get' OR kota_costumer REGEXP '^$get' OR no_costumer REGEXP '^$get' ORDER BY kota_costumer DESC");
    while($row = mysqli_fetch_assoc($sql)){
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