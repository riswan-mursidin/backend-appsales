<?php
error_reporting(0);
include "koneksi.php";

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
        </tr>
    </thead>
    <tbody>
        <tr style="font-size: smaller;">
            <td><?= $thn."-".$format = strlen($bln) != 2 ? '0'.$bln : $bln."-". $formatt = strlen($tgl) != 2 ? '0'.$tgl : $tgl ?></td>
            <td>Rp.500.000</td>
            
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
        </tr>
        <?php } ?>
    </tbody>
</table>

