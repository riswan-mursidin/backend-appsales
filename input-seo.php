<?php include "header.php"; 
if($_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>document.location.href = 'index';</script>";
}
?>

    <!-- Breadcrumb -->
    <div class="container mt-5 mb-3 breadcrumb-style mt-3">
        <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home">Home</a></li>
                <li class="breadcrumb-item active"><a href="#">SEO</a></li>
            </ol>
        </nav>
    </div>
    <section>
        <form action="" method="post" class="container">
            <?php  
                $querygoogle = mysqli_query($conn, "SELECT * FROM google_analysis WHERE id_admin='$_SESSION[user]'");
                $rowgoogle = mysqli_fetch_assoc($querygoogle);
                $valuegoogle = mysqli_num_rows($querygoogle) > 0 ? $rowgoogle['script_analysis'] : "";
            ?>
            <div class="row">
                <div class="mb-3">
                    <label for="google" class="form-label" style="font-weight:bold">GOOGLE ANALYTICS</label>
                     <p>Masukkan script Google Analytics</p>
                     <textarea name="google" id="google" rows="3" class="form-control"><?= $valuegoogle ?></textarea>
                </div>
                <div class="col-6 col-sm-3 mb-3">
                    <button name="googleaksi" type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
        <form action="" method="post"  class="container">
            <?php  
                $queryfb = mysqli_query($conn, "SELECT * FROM fb_pixel WHERE id_admin='$_SESSION[user]'");
                $rowfb = mysqli_fetch_assoc($queryfb);
                $valuefb = mysqli_num_rows($queryfb) > 0 ? $rowfb['script_pixel'] : "";
            ?>
            <div class="row">
                <div class="mb-3">
                    <label for="fb" class="form-label" style="font-weight:bold">Facebook Pixel</label>
                    <p>Masukkan script Facebok Pixel</p>
                    <textarea name="fb" id="fb" rows="3" class="form-control"><?= $valuefb ?></textarea>
                </div>
                <div class="col-6 col-sm-3 mb-3">
                    <button name="fbaksi" type="submit" class="btn btn-success">Simpan</button>                
                </div>
            </div>
        </form>
    </section>