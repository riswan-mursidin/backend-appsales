<?php
error_reporting(0);
include "koneksi.php";
$username = $_GET['username'];

// lama waktu kredit
$jangka_waktu = $_GET['jangka'];
$array_waktu = explode(" ", $jangka_waktu);
$jangka = $array_waktu[0];

// tgl bayar
$waktu_daftar = $_GET['tgl'];
$array_date = explode("-", $waktu_daftar);
$tgl = $array_date[2];
$bln = $array_date[1];
$thn = $array_date[0];
$kalender = CAL_GREGORIAN;

// nominal bayar
$querykret = mysqli_query($conn, "SELECT * FROM harga_kredit WHERE jangka_waktu='$jangka_waktu'");
$rownominal = mysqli_fetch_assoc($querykret);
?>

<table class="table" >
    <thead>
        <tr style="font-size: smaller;">
            <th scope="col">TANGGAL</th>
            <th scope="col">NOMINAL</th>
            <th scope="col">AKSI</th>
        </tr>
    </thead>
    <tbody>
        <tr style="font-size: smaller;">
            <td><?= $thn."-".$format = strlen($bln) != 2 ? '0'.$bln : $bln."-". $formatt = strlen($tgl) != 2 ? '0'.$tgl : $tgl ?></td>
            <td>Rp.500.000</td>
            <td>
                <?php  
                $querystatus = mysqli_query($conn, "SELECT username FROM story_cicilan WHERE tgl_transaksi='$waktu_daftar' AND nominal='500000' AND username = '$username'");
                if(mysqli_num_rows($querystatus)>0){
                ?>
                <div class="badge bg-primary" style="width: 7rem;border-radius:3px">LUNAS</div>
                <?php }else{ ?>
                    <a href="#konfir" data-bs-toggle="modal"><span class="material-icons">done</span></a>
                    <!-- Modal konfir-->
                    <div class="modal fade" id="konfir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">MengKonfirmasi Pembayaran!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Customer atas nama <?= ucfirst($username) ?> sudah membayar biaya setup?
                                </div>
                                <form method="post" action="" class="modal-footer">
                                    <input type="hidden" name="usernamee" value="<?= $username ?>">
                                    <input type="hidden" name="tgl" value="<?= $waktu_daftar ?>">
                                    <input type="hidden" name="nominal" value="500000">
                                    <button type="submit" name="pembayarankredit" class="btn btn-danger btn-save">Ya</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <a href="#aktifkannotif" data-bs-toggle="modal"><span class="material-icons">notifications_active</span></a>
                    <!-- end modal konfir -->
                <?php } ?>
            </td>
        </tr>
        <?php  
        $j = 1;
        for($i=1; $i<=$jangka; $i++){
            $blnbaru = $bln+$i;
            if($blnbaru > 12){
                $blnbaru = ++$j-1;
                $thnbaru = $thn + 1;
                $total_hari = cal_days_in_month($kalender, $blnbaru, $thnbaru);
                $jumlah_habis_bulan = $total_hari - $tgl;
                $tgl = 30 - $jumlah_habis_bulan;
            }else{
                $thnbaru = $thn;
                $total_hari = cal_days_in_month($kalender, $blnbaru, $thnbaru);
                $jumlah_habis_bulan = $total_hari - $tgl;
                $tgl = 30 - $jumlah_habis_bulan;
            }
        ?>
        <tr style="font-size: smaller;">
            <td><?= $thnbaru."-".$format = strlen($blnbaru) != 2 ? '0'.$blnbaru : $blnbaru ?>-<?= $formatt = strlen($tgl) != 2 ? '0'.$tgl : $tgl ?></td>
            <td>Rp.<?= number_format($rownominal['nominal'],0,",",".") ?></td>
            <td>
                <?php  
                $querystatus = mysqli_query($conn, "SELECT username FROM story_cicilan WHERE username = '$username' AND tgl_transaksi='$thnbaru-$blnbaru-$tgl' AND nominal='$rownominal[nominal]'");
                if(mysqli_num_rows($querystatus)>0){
                ?>
                <div class="badge bg-primary" style="width: 7rem;border-radius:3px">LUNAS</div>
                <?php }else{ ?>
                    <a href="#konfir<?= $i ?>" data-bs-toggle="modal"><span class="material-icons">done</span></a>
                    <!-- Modal konfir-->
                    <div class="modal fade" id="konfir<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">MengKonfirmasi Pembayaran!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Customer atas nama <?= ucfirst($username) ?> sudah melakukan Pembayaran?
                                </div>
                                <form method="post" action="" class="modal-footer">
                                    <input type="hidden" name="usernamee" value="<?= $username ?>">
                                    <input type="hidden" name="tgl" value="<?= $thnbaru."-"."$blnbaru"."-"."$tgl" ?>">
                                    <input type="hidden" name="nominal" value="<?= $rownominal['nominal'] ?>">
                                    <button type="submit" name="pembayarankredit" class="btn btn-danger btn-save">Ya</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end modal konfir -->
                    <a href="#aktifkannotif<?= $i ?>" data-bs-toggle="modal"><span class="material-icons">notifications_active</span></a>
                    <div class="modal fade" id="aktifkannotif<?= $i ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-sm modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Peringatan Pembayaran!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ingatkan Customer atas nama <?= ucfirst($username) ?> untuk melakukan pembayaran?
                                </div>
                                <form method="post" action="" class="modal-footer">
                                    <input type="hidden" name="usernamee" value="<?= $username ?>">
                                    <button type="submit" name="krmnotif" class="btn btn-danger btn-save">Ya</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

